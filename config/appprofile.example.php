<?php

declare(strict_types=1);

$_ENV['SingBox_Group_Indexes'] = [0];

$_ENV['SingBox_Config'] = [
    'log' => [
        'level' => 'debug',
    ],
    'dns' => [
        'servers' => [
            [
                'tag' => 'remote',
                'address' => 'tls://8.8.8.8',
            ],
            [
                'tag' => 'local',
                'address' => 'tcp://119.29.29.29',
                'detour' => 'direct',
            ],
        ],
        'rules' => [
            [
                'outbound' => 'any',
                'server' => 'local',
            ],
            [
                'clash_mode' => 'Direct',
                'server' => 'local',
            ],
            [
                'clash_mode' => 'Global',
                'server' => 'local',
            ],
            [
                'type' => 'logical',
                'mode' => 'and',
                'rules' => [
                    [
                        'geosite' => 'google@cn',
                        'invert' => true,
                    ],
                    [
                        'geosite' => [
                            'cn',
                            'apple@cn'
                        ],
                        'domain_suffix' => [
                            'download.jetbrains.com',
                            'icloud.com', 'cloud-content.com',
                            'cdn-apple.com'
                        ]
                    ],
                ],
                'server' => 'local',
            ],
        ],
        'strategy' => 'ipv4_only',
    ],
    'inbounds' => [
        [
            'type' => 'tun',
            'inet4_address' => '172.19.0.1/30',
            'auto_route' => true,
            'strict_route' => true,
            'endpoint_independent_nat' => true,
            'udp_timeout' => 60,
            'platform' => [
                'http_proxy' => [
                    'enabled' => true,
                    'server' => '127.0.0.1',
                    'server_port' => 8080,
                ],
            ],
            'sniff' => true,
        ],
        [
            'type' => 'mixed',
            'listen' => '127.0.0.1',
            'listen_port' => 8080,
            'sniff' => true,
            'domain_strategy' => 'prefer_ipv4',
        ],
    ],
    'outbounds' => [
        [
            'type' => 'selector',
            'tag' => 'default',
            'outbounds' => [
            ],
        ],
        [
            'type' => 'direct',
            'tag' => 'direct',
        ],
        [
            'type' => 'block',
            'tag' => 'block',
        ],
        [
            'type' => 'dns',
            'tag' => 'dns',
        ],
    ],
    'route' => [
        'rules' => [
            [
                'protocol' => 'dns',
                'outbound' => 'dns',
            ],
            [
                'network' => 'udp',
                'port' => 53,
                'outbound' => 'dns',
            ],
            [
                'clash_mode' => 'Direct',
                'outbound' => 'direct',
            ],
            [
                'clash_mode' => 'Global',
                'outbound' => 'default',
            ],
            [
                'network' => 'udp',
                'port' => 443,
                'outbound' => 'block',
            ],
            [
                'port' => 853,
                'outbound' => 'block',
            ],
            [
                'protocol' => 'stun',
                'outbound' => 'block',
            ],
            [
                'type' => 'logical',
                'mode' => 'and',
                'rules' => [
                    [
                        'geosite' => 'google@cn',
                        'invert' => true,
                    ],
                    [
                        'geosite' => [
                            'cn',
                        ],
                        'geoip' => [
                            'cn',
                            'private',
                        ],
                    ],
                ],
                'outbound' => 'direct',
            ],
        ],
        'auto_detect_interface' => true,
    ],
    'experimental' => [
        'clash_api' => [
            'external_controller' => '127.0.0.1:9090',
            'store_mode' => true,
            'store_selected' => true,
            'cache_id' => '',
        ],
    ],
];

$_ENV['Clash_Config'] = [
    'port' => 7890,
    'socks-port' => 7891,
    'allow-lan' => false,
    'mode' => 'Rule',
    'ipv6' => true,
    'log-level' => 'error',
    'external-controller' => '0.0.0.0:9090',
];

$_ENV['Clash_Group_Indexes'] = [0];

$_ENV['Clash_Group_Config'] = [
    'proxy-groups' => [
        [
            'name' => '',
            'type' => 'select',
            'proxies' => [
            ],
        ]
    ],
];
