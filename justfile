default:
    just --list

pre_req:
    bun -v
    php -v
    npm -v
    node -v
    echo 'This is not a complete list yet but php should be version 8.3'

pre_req_install:
    sudo update-alternatives --set php /usr/bin/php8.3
    curl -fsSL https://bun.sh/install | bash # Install bun
    echo 'This is not a complete list yet'

initial_setup:
    cp laravel-backend/.env.example laravel-backend/.env
    cp svelte/.env.example svelte/.env
    just install
    just gen_openapi
    cd laravel-backend && php artisan migrate --seed && php artisan storage:link && php artisan key:generate
    just test
    echo 'You will now need to ln the nginx config and restart nginx'
    echo ''
    echo 'ln laravel-svelte-template.conf /etc/nginx/sites-enables/laravel-svelte-template.conf'
    echo 'Note hard links cannot be across partitions, if your home and root are on different partitions simply copy the config'
    echo 'systemctl restart nginx'

install:
    cd typespec-openapi && tsp install
    cd laravel-backend && composer install
    cd svelte && bun i

format:
    cd laravel-backend && composer format
    cd svelte && bun format

gen_openapi:
    cd typespec-openapi && just compile
    rm -if laravel-backend/public/openapi.yaml
    ln typespec-openapi/tsp-output/@typespec/openapi3/openapi.yaml `pwd`/laravel-backend/public/openapi.yaml
    cd svelte && bun gen_backend_types

test:
    just gen_openapi
    cd svelte && bun check
    bun test
    cd laravel-backend && composer test

pre_commit:
    just gen_openapi
    just format
    just test

follow_logs:
    tail -f laravel-backend/storage/logs/laravel.log | jq

