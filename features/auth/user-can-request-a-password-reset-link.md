# User can request a password reset link

**Owner:**
**Status:** Draft
**Linked:** #3

## Acceptance Criteria

| ID        | Behaviour                          | Level    | Priority |
|-----------|------------------------------------|----------|----------|
| PR-1 | (describe the first behaviour)   | feature  | Must     |

## Notes

A user who has forgotten their password should be able to request a reset link by submitting their email address. The link is single-use, expires after 60 minutes, and never reveals whether the email is registered.

## Behaviour

- Anyone (authenticated or not) can submit an email to `POST /password/forgot`.
- The endpoint always returns 204, regardless of whether the email is registered.
- If the email matches a user, a reset token is generated and emailed to that address.
- The token is a single-use, 60-minute-TTL signed URL.
- Submitting the same email more than once within 60 seconds returns 204 but does not send a second email (rate-limit per email).
- Submitting more than 10 distinct emails from one IP within 5 minutes returns 429.

## Out of scope

- The reset confirmation page itself (separate spec).
- Multi-factor / step-up auth on reset (separate spec).
