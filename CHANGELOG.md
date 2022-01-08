# Changelog

All notable changes to this project will be documented in this file.

The format is based on [keep a changelog][xtlink-keep-a-changelog]
and this project adheres to [Semantic Versioning 2.0.0][xtlink-semantic-versioning].

## [0.4.0] - 2022-01-08

### Added

* composer package dependencies
  * added
    * `codekandis/configurations` [^0]
* session authenticator configuration

[0.4.0]: https://github.com/codekandis/authentication/compare/0.3.0..0.4.0

---
## [0.3.0] - 2021-01-18

### Changed

* composer package dependencies
  * removed
    * `sensiolabs/security-checker`  
    * `phpunit/phpunit`
  * changed
    * `minimum-stability` [stable]
  * added
    * `codekandis/phpunit` [^3]
* `PHPUnit` configuration

[0.3.0]: https://github.com/codekandis/authentication/compare/0.2.0..0.3.0

---
## [0.2.0] - 2020-09-29

### Added

* authorization header parser

[0.2.0]: https://github.com/codekandis/authentication/compare/0.1.0..0.2.0

---
## [0.1.0] - 2020-09-28

### Added

* common authentication
  * credentials
  * stateless authenticator interface
  * stateless authenticator
  * stateful authenticator interface
  * stateful session based authenticator
* key based authentication
  * credentials
  * stateless authenticator interface
  * stateless authenticator
  * stateful authenticator interface
  * stateful session based authenticator
    
[0.1.0]: https://github.com/codekandis/authentication/tree/0.1.0



[xtlink-keep-a-changelog]: http://keepachangelog.com/en/1.0.0/
[xtlink-semantic-versioning]: http://semver.org/spec/v2.0.0.html
