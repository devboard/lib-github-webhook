CHANGELOG

Version 3.x [xxxx-xx-xx]:

 - Add and use InstallationDetails representation instead of GitHubInstallation #102
 - Add and use IssueCommentDetails representation instead of GitHubIssue #105
 - Add paraunit in order to run phpunit tests in parallel
 - Mark Tag factories as skipped as we have no data to test them out now

Version 2.0.1 [2018-07-28]:

 - Stop PHP linting on CI
 - Remove coverage-php as that option doesnt exist
 - GitHubHookEvent should define serialize/deserialize methods

Version 2.0.0 [2018-07-20]:

 - Add `asString()` and deprecate `__toString()`
 - Drop internal ExternalServiceFactory
 - Use GitHubStatusCheck instead of GitHubStatus
 - Add GitHubStatusCheck


Version 1.2.0 [2018-07-16]:

 - Upgrade phpspec to 5.x 
 - add phpstan/phpstan-strict-rules
 - fix violations reported by phpstan/phpstan-strict-rules
 - Deprecate ExternalServiceFactory (DEV-12
 - Use ExternalServiceFactory from lib-github (DEV-12)
 - Upgrade devboard/lib-github to 1.2

Version 1.1.0 [2018-06-25]:
 - Ugpgrading phpstan (0.10) & infection (0.9dev)
 - Upgrade devboard/lib-github, min is now 1.1
 - Ensure gmdate gets integers in
 - PHPStan: ignore json_decode string expectations

 
Version 1.0: Up to this point, there is no documentation on given code but we do hope to fix that soon :)

