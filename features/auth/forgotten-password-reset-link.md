# Forgotten password reset link

**Owner:**
**Status:** Draft
**Linked:** #7

## Acceptance Criteria

| ID    | Behaviour                                                  | Level    | Priority |
|-------|------------------------------------------------------------|----------|----------|
| AC-1  | POST /password/forgot accepts a single `email` field.      | feature  | Must     |
| AC-2  | Returns 204 regardless of whether the email is registered, not registered, or malformed. | security | Must     |
| AC-3  | Sends a reset link by email when the address matches a registered user. | feature  | Must     |
| AC-4  | Reset links are single-use.                                | security | Must     |
| AC-5  | Reset links expire 60 minutes after issuance.              | security | Must     |
| AC-6  | Rate-limits requests to one per email address per minute.  | security | Must     |
| AC-7  | Rate-limits requests to 10 distinct email addresses per IP per 5 minutes. | security | Must     |
| AC-8  | Returns 429 when a rate limit is exceeded.                 | security | Must     |

## Notes

Users who can't remember their password should be able to ask for a reset link by typing their email into a form. We don't want to leak whether an email is registered, so the response is always the same.

Some details I care about:

- The endpoint is POST /password/forgot. It takes a single field, `email`.
- It always returns 204, no matter what — registered, not registered, malformed, doesn't matter (within reason; obviously a totally broken request still 4xx's).
- If the email matches a user, they get a reset link by email. The link is single-use and expires after 60 minutes.
- Don't let attackers DOS us: rate-limit to one email per address per minute, and 10 distinct addresses per IP per 5 minutes (return 429 when that's exceeded).

The reset confirmation page itself is a separate piece of work — out of scope here. Same for any MFA / step-up auth on reset.
