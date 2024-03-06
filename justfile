default:
    just --list

format:
    cd laravel && composer format
    cd svelte && bun format

generate_docs:
    cd laravel && php artisan scribe:generate

pre_commit:
    just format
    just generate_docs
