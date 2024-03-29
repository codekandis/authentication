# Changelog

All notable changes to this project will be documented in this file.

The format is based on [keep a changelog][xtlink-keep-a-changelog]
and this project adheres to [Semantic Versioning 2.0.0][xtlink-semantic-versioning].

## [0.9.0] - 2022-08-11

### Changed

* renamed `passcode` to `password`

[0.9.0]: https://github.com/codekandis/authentication/compare/0.8.0...0.9.0

---
## [0.8.0] - 2022-06-25

### Changed

* made the LDAP connector on LDAP authenticator constructors optional

[0.8.0]: https://github.com/codekandis/authentication/compare/0.7.0...0.8.0

---
## [0.7.0] - 2022-06-24

### Fixed

* PHPDoc

### Added

* session authenticator initialization by configuration
* LDAP authenticator configuration
* LDAP session authenticator configuration

[0.7.0]: https://github.com/codekandis/authentication/compare/0.6.0...0.7.0

---
## [0.6.0] - 2022-05-21

### Added

* LDAP authentication
  * credentials
  * stateless authenticator interface
  * stateful authenticator interface
  * abstract authenticator
  * stateless authenticator
  * stateful session based authenticator

[0.6.0]: https://github.com/codekandis/authentication/compare/0.5.0...0.6.0

---
## [0.5.0] - 2022-05-11

### Changed

* composer package dependencies
  * removed
    * `codekandis/configurations`
  * changed
    * description

[0.5.0]: https://github.com/codekandis/authentication/compare/0.4.0...0.5.0

---
## [0.4.0] - 2022-01-08

### Added

* composer package dependencies
  * added
    * `codekandis/configurations` [^0]
* session authenticator configuration

[0.4.0]: https://github.com/codekandis/authentication/compare/0.3.0...0.4.0

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

[0.3.0]: https://github.com/codekandis/authentication/compare/0.2.0...0.3.0

---
## [0.2.0] - 2020-09-29

### Added

* authorization header parser

[0.2.0]: https://github.com/codekandis/authentication/compare/0.1.0...0.2.0

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
