<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Языковые ресурсы для проверки значений
    |--------------------------------------------------------------------------
    |
    | Последующие языковые строки содержат сообщения по-умолчанию, используемые
    | классом, проверяющим значения (валидатором). Некоторые из правил имеют
    | несколько версий, например, size. Вы можете поменять их на любые
    | другие, которые лучше подходят для вашего приложения.
    |
    */

    'accepted'             => 'Вы должны принять :attribute.',
    'active_url'           => 'Поле :attribute содержит недействительный URL.',
    'after'                => 'В поле :attribute должна быть дата после :date.',
    'after_or_equal'       => 'В поле :attribute должна быть дата после или равняться :date.',
    'alpha'                => 'Поле :attribute может содержать только буквы.',
    'alpha_dash'           => 'Поле :attribute может содержать только буквы, цифры, дефис и нижнее подчеркивание.',
    'alpha_num'            => 'Поле :attribute может содержать только буквы и цифры.',
    'array'                => 'Поле :attribute должно быть массивом.',
    'before'               => 'В поле :attribute должна быть дата до :date.',
    'before_or_equal'      => 'В поле :attribute должна быть дата до или равняться :date.',
    'between'              => [
        'numeric' => 'Поле :attribute должно быть между :min и :max.',
        'file'    => 'Размер файла в поле :attribute должен быть между :min и :max Килобайт(а).',
        'string'  => 'Количество символов в поле :attribute должно быть между :min и :max.',
        'array'   => 'Количество элементов в поле :attribute должно быть между :min и :max.',
    ],
    'boolean'              => 'Поле :attribute должно иметь значение логического типа.', // калька 'истина' или 'ложь' звучала бы слишком неестественно
    'confirmed'            => 'Поле :attribute не совпадает с подтверждением.',
    'date'                 => 'Поле :attribute не является датой.',
    'date_format'          => 'Поле :attribute не соответствует формату :format.',
    'different'            => 'Поля :attribute и :other должны различаться.',
    'digits'               => 'Длина цифрового поля :attribute должна быть :digits.',
    'digits_between'       => 'Длина цифрового поля :attribute должна быть между :min и :max.',
    'dimensions'           => 'Поле :attribute имеет недопустимые размеры изображения.',
    'distinct'             => 'Поле :attribute содержит повторяющееся значение.',
    'email'                => 'Поле :attribute должно быть действительным электронным адресом.',
    'exists'               => 'Выбранное значение для :attribute некорректно.',
    'file'                 => 'Поле :attribute должно быть файлом.',
    'filled'               => 'Поле :attribute обязательно для заполнения.',
    'gt'                   => [
        'numeric' => 'Поле :attribute должно быть больше :value.',
        'file'    => 'Размер файла в поле :attribute должен быть больше :value Килобайт(а).',
        'string'  => 'Количество символов в поле :attribute должно быть больше :value.',
        'array'   => 'Количество элементов в поле :attribute должно быть больше :value.',
    ],
    'gte'                  => [
        'numeric' => 'Поле :attribute должно быть больше или равно :value.',
        'file'    => 'Размер файла в поле :attribute должен быть больше или равен :value Килобайт(а).',
        'string'  => 'Количество символов в поле :attribute должно быть больше или равно :value.',
        'array'   => 'Количество элементов в поле :attribute должно быть больше или равно :value.',
    ],
    'image'                => 'Поле :attribute должно быть изображением.',
    'in'                   => 'Выбранное значение для :attribute ошибочно.',
    'in_array'             => 'Поле :attribute не существует в :other.',
    'integer'              => 'Поле :attribute должно быть целым числом.',
    'ip'                   => 'Поле :attribute должно быть действительным IP-адресом.',
    'ipv4'                 => 'Поле :attribute должно быть действительным IPv4-адресом.',
    'ipv6'                 => 'Поле :attribute должно быть действительным IPv6-адресом.',
    'json'                 => 'Поле :attribute должно быть JSON строкой.',
    'lt'                   => [
        'numeric' => 'Поле :attribute должно быть меньше :value.',
        'file'    => 'Размер файла в поле :attribute должен быть меньше :value Килобайт(а).',
        'string'  => 'Количество символов в поле :attribute должно быть меньше :value.',
        'array'   => 'Количество элементов в поле :attribute должно быть меньше :value.',
    ],
    'lte'                  => [
        'numeric' => 'Поле :attribute должно быть меньше или равно :value.',
        'file'    => 'Размер файла в поле :attribute должен быть меньше или равен :value Килобайт(а).',
        'string'  => 'Количество символов в поле :attribute должно быть меньше или равно :value.',
        'array'   => 'Количество элементов в поле :attribute должно быть меньше или равно :value.',
    ],
    'max'                  => [
        'numeric' => 'Поле :attribute не может быть более :max.',
        'file'    => 'Размер файла в поле :attribute не может быть более :max Килобайт(а).',
        'string'  => 'Количество символов в поле :attribute не может превышать :max.',
        'array'   => 'Количество элементов в поле :attribute не может превышать :max.',
    ],
    'mimes'                => 'Поле :attribute должно быть файлом одного из следующих типов: :values.',
    'mimetypes'            => 'Поле :attribute должно быть файлом одного из следующих типов: :values.',
    'min'                  => [
        'numeric' => 'Поле :attribute должно быть не менее :min.',
        'file'    => 'Размер файла в поле :attribute должен быть не менее :min Килобайт(а).',
        'string'  => 'Количество символов должно быть не менее :min.',
        'array'   => 'Количество элементов должно быть не менее :min.',
    ],
    'not_in'               => 'Выбранное значение для :attribute ошибочно.',
    'not_regex'            => 'Выбранный формат для :attribute ошибочный.',
    'numeric'              => 'Поле :attribute должно быть числом.',
    'present'              => 'Поле :attribute должно присутствовать.',
    'regex'                => 'Поле :attribute имеет ошибочный формат.',
    'required'             => 'Поле :attribute обязательно для заполнения.',
    'required_if'          => 'Поле :attribute обязательно для заполнения, когда :other равно :value.',
    'required_unless'      => 'Поле :attribute обязательно для заполнения, когда :other не равно :values.',
    'required_with'        => 'Поле :attribute обязательно для заполнения, когда :values указано.',
    'required_with_all'    => 'Поле :attribute обязательно для заполнения, когда :values указано.',
    'required_without'     => 'Поле :attribute обязательно для заполнения, когда :values не указано.',
    'required_without_all' => 'Поле :attribute обязательно для заполнения, когда ни одно из :values не указано.',
    'same'                 => 'Значения полей :attribute и :other должны совпадать.',
    'size'                 => [
        'numeric' => 'Поле :attribute должно быть равным :size.',
        'file'    => 'Размер файла в поле :attribute должен быть равен :size Килобайт(а).',
        'string'  => 'Количество символов в поле :attribute должно быть равным :size.',
        'array'   => 'Количество элементов в поле :attribute должно быть равным :size.',
    ],
    'string'               => 'Поле :attribute должно быть строкой.',
    'timezone'             => 'Поле :attribute должно быть действительным часовым поясом.',
    'unique'               => 'Такое значение поля :attribute уже существует.',
    'uploaded'             => 'Загрузка поля :attribute не удалась.',
    'url'                  => 'Поле :attribute имеет ошибочный формат.',
    'uuid'                 => 'Поле :attribute должно быть корректным UUID.',

    /*
    |--------------------------------------------------------------------------
    | Собственные языковые ресурсы для проверки значений
    |--------------------------------------------------------------------------
    |
    | Здесь Вы можете указать собственные сообщения для атрибутов.
    | Это позволяет легко указать свое сообщение для заданного правила атрибута.
    |
    | http://laravel.com/docs/validation#custom-error-messages
    | Пример использования
    |
    |   'custom' => [
    |       'email' => [
    |           'required' => 'Нам необходимо знать Ваш электронный адрес!',
    |       ],
    |   ],
    |
    */

    'custom' => [
        'title_block' => [
            'max'      => 'Количество символов в поле Заголовок не может превышать 150.',
            'min'      => 'Количество символов в поле Заголовок должно быть не менее 5.',
            'required' => 'Поле Заголовок обязательное для заполнения.',
        ],
        'text_block'  => [
            'max'      => 'Количество символов в поле Текст не может превышать 150.',
            'min'      => 'Количество символов в поле Текст должно быть не менее 25.',
            'required' => 'Поле Текст обязательное для заполнения.',
        ],
        'active'      => [
            'required' => 'Поле Заголовок обязательное для заполнения.',
        ],
        'category'    => [
            'required' => 'Поле Категория обязательное для заполнения.',
        ],
        'avatar'      => [
            'image'      => 'Логотип должен быть изображением.',
            'dimensions' => 'Минимальный размер логотипа 265х265.',
            'max'        => 'Размер логотипа не должен превышать 5Мб.',
            'mimes'      => 'Допускаются только расширения PNG, JPG, JPEG.',
        ],
        'user_sname'  => [
            'required' => 'Поле Фамилия обязательное для заполнения.',
        ],
        'user_fname'  => [
            'required' => 'Поле Имя обязательное для заполнения.',
        ],
        'user_mname'  => [
            'required' => 'Поле Отчество обязательное для заполнения.',
        ],
        'user_phone'  => [
            'required' => 'Поле Телефон обязательное для заполнения.',
        ],
        'user_email'  => [
            'required' => 'Поле Email обязательное для заполнения.',
        ],
        'user_city'   => [
            'required' => 'Поле Город обязательное для заполнения.',
        ],
        'user_pass'   => [
            'required' => 'Поле Пароль обязательное для заполнения.',
        ],
        'banner'      => [
            'max'        => 'Размер картинки не должен превышать 5Мб.',
            'mimes'      => 'Допускаются только расширения PNG, JPG, JPEG.',
            'dimensions' => 'Минимальный размер картинки 200х200.',
            'image'      => 'Картинка должен быть изображением.',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Собственные названия атрибутов
    |--------------------------------------------------------------------------
    |
    | Последующие строки используются для подмены программных имен элементов
    | пользовательского интерфейса на удобочитаемые. Например, вместо имени
    | поля "email" в сообщениях будет выводиться "электронный адрес".
    |
    | Пример использования
    |
    |   'attributes' => [
    |       'email' => 'электронный адрес',
    |   ],
    |
    */

    'attributes' => [
        'name'                  => 'Имя',
        'username'              => 'Никнейм',
        'email'                 => 'E-Mail адрес',
        'first_name'            => 'Имя',
        'last_name'             => 'Фамилия',
        'password'              => 'Пароль',
        'password_confirmation' => 'Подтверждение пароля',
        'city'                  => 'Город',
        'country'               => 'Страна',
        'address'               => 'Адрес',
        'phone'                 => 'Телефон',
        'mobile'                => 'Моб. номер',
        'age'                   => 'Возраст',
        'sex'                   => 'Пол',
        'gender'                => 'Пол',
        'day'                   => 'День',
        'month'                 => 'Месяц',
        'year'                  => 'Год',
        'hour'                  => 'Час',
        'minute'                => 'Минута',
        'second'                => 'Секунда',
        'title'                 => 'Наименование',
        'content'               => 'Контент',
        'description'           => 'Описание',
        'excerpt'               => 'Выдержка',
        'date'                  => 'Дата',
        'time'                  => 'Время',
        'available'             => 'Доступно',
        'size'                  => 'Размер',
        'status'                => 'Статус',
        'g-recaptcha-response'  => 'Капча',
        //'fio'                   => 'Фамилия, Имя, Отчество заявителя',
        'igree'                 => 'Соглашение',
        'message'               => 'Сообщение',
        'link'                  => 'Урл',
        'header'                => 'Описание',
        'domain_name'           => 'Имя сайта',
        'options'               => 'Ответы',
        'banner'                => 'Картинка',
        'domain'                => 'Адреса',
        'images'                => "Картинки к статье",
        'query'                 => 'Поиск',
        'preview'               => 'Краткое описание',
        'published_at'          => 'Дата публикации',
        'background'            => 'Фон',
        'cat_name'              => 'Название пункта меню',
        'slug'                  => 'Адрес пункта меню',
        'slug_article'          => 'Адрес статьи',
        'scan'                  => 'Скан платежа',
        'anchor'                => 'Название ссылки',
        'sname'                 => 'Фамилия',
        'fname'                 => 'Имя',
        'mname'                 => 'Отчество',
        'preview_image'         => 'Превью к анонсу',
    ],
];
