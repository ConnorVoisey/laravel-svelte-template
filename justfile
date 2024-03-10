default:
    just --list

pre_commit:
    just generate_docs
    just format
    just test

format:
    cd laravel && composer format
    cd svelte && bun format

generate_docs:
    cd laravel && php artisan openapi:generate > ./storage/app/docs/openApi.json
    cd svelte && bun gen_backend_types

test:
    just generate_docs
    cd svelte && bun tsc --noEmit
    bun test
    cd laravel && composer test
