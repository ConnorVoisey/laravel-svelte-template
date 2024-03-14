default:
    just --list

install:
    cd laravel && composer install
    cd svelte && bun i

format:
    cd laravel && composer format
    cd svelte && bun format

generate_docs:
    cd svelte && bun gen_backend_types

test:
    just generate_docs
    cd svelte && bun check
    bun test
    cd laravel && composer test

pre_commit:
    just generate_docs
    just format
    just test
