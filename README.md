# TLS

TODO
add traefik before use mksert

Certificates generated via mkcert.
To enable it for local development
1) Install [mkcert](https://github.com/FiloSottile/mkcert)
2) do:
```
$ mkcert -cert-file docker/traefik/certs/local-cert.pem -key-file docker/traefik/certs/local-key.pem "emigraniada.localhost" "*.emigraniada.localhost" swb.localhost "*.emigraniada.localhost"
$ mkcert -install
```
