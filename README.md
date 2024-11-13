# php-aws-bulk-upload-sample

Testing various configurations to reproduce [this issue](https://github.com/aws/aws-sdk-php/issues/2992#issuecomment-2471735696).

### Setup

1. See `file_metadata.txt` and generate test files that are similar and put them into `./input`
2. Create S3 bucket and rename values for `$bucket` and `$key` in `run.php`
2. Set AWS credential environment variables in your shell

### Running

#### :white_check_mark: Alpine 3.19
  * PHP 8.2.25
  * curl 8.9.1 
  * OpenSSL 3.1.7

```sh
$ docker compose run --build --rm alpine
```

#### :x: Debian Bookworm
  * PHP 8.2.24
  * curl 7.88.1 
  * OpenSSL 3.0.15

```sh
$ docker compose run --build --rm debian
```

#### :x: Debian Bookworm (cURL backport)
  * PHP 8.2.24
  * curl 8.10.1 
  * OpenSSL 3.0.15

```sh
$ docker compose run --build --rm debian.backport
```