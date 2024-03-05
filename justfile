default:
    just --list

format:
    cd laravel && composer format
    cd svelte && bun format
