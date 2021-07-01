# Development kit REST API with Lumen

## How to install

1. Install package

```bash
composer install
```

2. Create .env file

3. Generate Keys

```bash
php artisan key:generate
php artisan jwt:secret
```

4. Migrate database

```bash
php artisan migrate:fresh --seed
```

5. Run app

```bash
sh run.sh
```

## Available Api Path

1. login (POST: /api/login)
2. register (POST: /api/register)
3. Users
    - index [ GET: /api/users ]
    - show [ GET: /api/users/{id} ]
    - update [ PUT: /api/users/{id} ]
4. Posts
    - index [ GET: /api/posts ]
    - store [ POST: /api/posts ]
    - show [ GET: /api/posts/{id} ]
    - update [ PUT: /api/posts/{id} ]
    - delete [ DELETE: /api/posts/{id} ]

## Available Api Resource

1. Fields
   Example url encode

    - [ /api/posts/?fields=content,created_at ]
    - [ /api/posts/?fields=content,created_at,profile.gender ]
    - [ /api/posts/?fields=*,profile.* ]

2. Includes
   Example url encode

    - [ /api/posts/?includes=user ]
    - [ /api/posts/?includes=user,user.profile ]

## Available Api Filter

1. Search

    - [ /api/posts/?search=find]
    - [ /api/posts/?search[0]=find&search[1]=find ]

2. Attribute

    - [ /api/posts/?title=find ]
    - [ /api/posts/?title[0]=find&title[1]=find ]

3. Condition

    - [ /api/posts/?title=find&title_condition=like ]
    - [ /api/posts/?title[0]=find&title_condition[0]=<>&title[1]=find&title_condition[1]=like ]

And enjoy!
