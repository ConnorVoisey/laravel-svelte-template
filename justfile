default:
    just --list

install:
    cd laravel-backend && composer install
    cd svelte && bun i

format:
    cd laravel-backend && composer format
    cd svelte && bun format

generate_docs:
    cd svelte && bun gen_backend_types

test:
    just generate_docs
    cd svelte && bun check
    bun test
    cd laravel-backend && composer test

pre_commit:
    just generate_docs
    just format
    just test

follow_logs:
    tail -f laravel-backend/storage/logs/laravel.log | jq

link_openapi:
    ln typespec-openapi/tsp-output/@typespec/openapi3/openapi.yaml `pwd`/laravel-backend/public/openapi.yaml

