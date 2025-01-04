CREATE TABLE catalogue_admin (
    admin_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    hashed_pass VARCHAR(255) NOT NULL
);

-- Admin accounts (password: Password2!)
INSERT INTO catalogue_admin (username, hashed_pass) VALUES
('instructor', '$2a$04$bUb/eytqph9cl02nJTlQqePJHJFAussLmkDSzvhp.oFJ9KWV6zMM.'),
('student', '$2a$04$bUb/eytqph9cl02nJTlQqePJHJFAussLmkDSzvhp.oFJ9KWV6zMM.');

CREATE TABLE matches (
    match_id INT AUTO_INCREMENT PRIMARY KEY,
    match_date DATE NOT NULL,
    opponent VARCHAR(255) NOT NULL,
    venue VARCHAR(255) NOT NULL,
    formation VARCHAR(10) NOT NULL,
    score_united INT,
    score_opponent INT,
    possession DECIMAL(4,1) NOT NULL,
    shots INT,
    shots_on_target INT,
    passes INT,
    pass_accuracy DECIMAL(4,1) NOT NULL,
    fouls INT,
    yellow_cards INT,
    red_cards INT,
    corners INT,
    offsides INT,
    match_image VARCHAR(255),
    match_description TEXT NOT NULL,
    lineup_json JSON NOT NULL,
    subs_json JSON NOT NULL,
    added_by VARCHAR(50) NOT NULL,
    date_added DATETIME NOT NULL,
    last_edited_by VARCHAR(50),
    date_edited DATETIME
);

INSERT INTO matches (
    match_date,
    opponent,
    venue,
    formation,
    score_united,
    score_opponent,
    possession,
    shots,
    shots_on_target,
    passes,
    pass_accuracy,
    fouls,
    yellow_cards,
    red_cards,
    corners,
    offsides,
    match_image,
    match_description,
    lineup_json,
    subs_json,
    added_by,
    date_added
) VALUES (
    '2024-12-01',
    'Everton',
    'Old Trafford',
    '3-4-2-1',
    4,
    0,
    60.0,
    11,
    5,
    630,
    89.0,
    12,
    2,
    0,
    2,
    3,
    '',
    'A dominant performance saw United secure a 4-0 victory, with Rashford opening the scoring in spectacular fashion. United controlled possession throughout, demonstrating tactical superiority with the new 3-4-2-1 formation.',
    '{
        "formation": "3-4-2-1",
        "players": [
            {"number": 24, "name": "A. Onana"},
            {"number": 3, "name": "N. Mazraoui"},
            {"number": 4, "name": "M. de Ligt"},
            {"number": 6, "name": "L. Martinez"},
            {"number": 16, "name": "A. Diallo"},
            {"number": 37, "name": "K. Mainoo"},
            {"number": 18, "name": "Casemiro"},
            {"number": 20, "name": "D. Dalot"},
            {"number": 10, "name": "M. Rashford"},
            {"number": 8, "name": "B. Fernandes"},
            {"number": 11, "name": "J. Zirkzee"}
        ]
    }',
    '{
        "used": [
            {"number": 5, "name": "Harry Maguire"},
            {"number": 7, "name": "Mason Mount"},
            {"number": 17, "name": "Alejandro Garnacho"},
            {"number": 23, "name": "Luke Shaw"},
            {"number": 25, "name": "Manuel Ugarte"}
        ],
        "unused": [
            {"number": 1, "name": "Altay Bayindir"},
            {"number": 9, "name": "Rasmus Hojlund"},
            {"number": 12, "name": "Tyrell Malacia"},
            {"number": 21, "name": "Antony"}
        ]
    }',
    'admin',
    NOW()
);

INSERT INTO matches (
    match_date,
    opponent,
    venue,
    formation,
    score_united,
    score_opponent,
    possession,
    shots,
    shots_on_target,
    passes,
    pass_accuracy,
    fouls,
    yellow_cards,
    red_cards,
    corners,
    offsides,
    match_image,
    match_description,
    lineup_json,
    subs_json,
    added_by,
    date_added
) VALUES (
    '2024-12-07',
    'Nottm Forest',
    'Old Trafford',
    '3-4-2-1',
    2,
    3,
    72.0,
    17,
    7,
    681,
    87.0,
    10,
    0,
    0,
    5,
    0,
    '',
    'United suffered a 3-2 defeat at Old Trafford against Nottingham Forest. Rasmus Hojlund (18\') and Bruno Fernandes (51\') scored for United.',
    '{
        "formation": "3-4-2-1",
        "players": [
            {"number": 24, "name": "A. Onana"},
            {"number": 15, "name": "L. Yao"},
            {"number": 4, "name": "M. de Ligt"},
            {"number": 6, "name": "L. Martinez"},
            {"number": 16, "name": "A. Diallo"},
            {"number": 37, "name": "K. Mainoo"},
            {"number": 25, "name": "M. Ugarte"},
            {"number": 20, "name": "D. Dalot"},
            {"number": 8, "name": "B. Fernandes"},
            {"number": 17, "name": "A. Garnacho"},
            {"number": 9, "name": "R. Hojlund"}
        ]
    }',
    '{
        "used": [
            {"number": 3, "name": "Noussair Mazraoui"},
            {"number": 5, "name": "Harry Maguire"},
            {"number": 7, "name": "Mason Mount"},
            {"number": 10, "name": "Marcus Rashford"},
            {"number": 11, "name": "Joshua Zirkzee"}
        ],
        "unused": [
            {"number": 1, "name": "Altay Bayindir"},
            {"number": 12, "name": "Tyrell Malacia"},
            {"number": 14, "name": "Christian Eriksen"},
            {"number": 18, "name": "Casemiro"}
        ]
    }',
    'admin',
    NOW()
);

INSERT INTO matches (
    match_date,
    opponent,
    venue,
    formation,
    score_united,
    score_opponent,
    possession,
    shots,
    shots_on_target,
    passes,
    pass_accuracy,
    fouls,
    yellow_cards,
    red_cards,
    corners,
    offsides,
    match_image,
    match_description,
    lineup_json,
    subs_json,
    added_by,
    date_added
) VALUES (
    '2024-12-04',
    'Arsenal',
    'Emirates Stadium',
    '3-4-2-1',
    0,
    2,
    49.0,
    5,
    2,
    476,
    86.0,
    8,
    3,
    0,
    0,
    2,
    '',
    'United suffered a 2-0 defeat at the Emirates Stadium against Arsenal. Goals from Jurrien Timber (54\') and William Saliba (73\') sealed the victory for the Gunners.',
    '{
        "formation": "3-4-2-1",
        "players": [
            {"number": 24, "name": "A. Onana"},
            {"number": 3, "name": "N. Mazraoui"},
            {"number": 5, "name": "H. Maguire"},
            {"number": 4, "name": "M. de Ligt"},
            {"number": 12, "name": "T. Malacia"},
            {"number": 8, "name": "B. Fernandes"},
            {"number": 25, "name": "M. Ugarte"},
            {"number": 20, "name": "D. Dalot"},
            {"number": 17, "name": "A. Garnacho"},
            {"number": 7, "name": "M. Mount"},
            {"number": 9, "name": "R. Hojlund"}
        ]
    }',
    '{
        "used": [
            {"number": 10, "name": "Marcus Rashford"},
            {"number": 11, "name": "Joshua Zirkzee"},
            {"number": 15, "name": "Leny Yoro"},
            {"number": 16, "name": "Amad Diallo"},
            {"number": 21, "name": "Antony"}
        ],
        "unused": [
            {"number": 1, "name": "Altay Bayindir"},
            {"number": 14, "name": "Christian Eriksen"},
            {"number": 18, "name": "Casemiro"},
            {"number": 87, "name": "Godwill Kukonki"}
        ]
    }',
    'admin',
    NOW()
);

INSERT INTO matches (
    match_date,
    opponent,
    venue,
    formation,
    score_united,
    score_opponent,
    possession,
    shots,
    shots_on_target,
    passes,
    pass_accuracy,
    fouls,
    yellow_cards,
    red_cards,
    corners,
    offsides,
    match_image,
    match_description,
    lineup_json,
    subs_json,
    added_by,
    date_added
) VALUES (
    '2024-11-28',
    'Bodo/Glimt',
    'Old Trafford',
    '3-4-2-1',
    3,
    2,
    73.0,
    20,
    6,
    787,
    91.0,
    7,
    2,
    0,
    2,
    0,
    '',
    'United secured a 3-2 victory in the Europa League against Bodo/Glimt. Goals from Alejandro Garnacho (1\') and Rasmus Hojlund (45\', 50\') sealed the win, with Hakon Evjen (19\') and Philip Zinckernagel (23\') scoring for the visitors.',
    '{
        "formation": "3-4-2-1",
        "players": [
            {"number": 24, "name": "A. Onana"},
            {"number": 3, "name": "N. Mazraoui"},
            {"number": 4, "name": "M. de Ligt"},
            {"number": 6, "name": "L. Martinez"},
            {"number": 21, "name": "Antony"},
            {"number": 25, "name": "M. Ugarte"},
            {"number": 8, "name": "B. Fernandes"},
            {"number": 12, "name": "T. Malacia"},
            {"number": 7, "name": "M. Mount"},
            {"number": 17, "name": "A. Garnacho"},
            {"number": 9, "name": "R. Hojlund"}
        ]
    }',
    '{
        "used": [
            {"number": 10, "name": "Marcus Rashford"},
            {"number": 16, "name": "Amad Diallo"},
            {"number": 18, "name": "Casemiro"},
            {"number": 20, "name": "Diogo Dalot"},
            {"number": 23, "name": "Luke Shaw"}
        ],
        "unused": [
            {"number": 1, "name": "Altay Bayindir"},
            {"number": 11, "name": "Joshua Zirkzee"},
            {"number": 14, "name": "Christian Eriksen"},
            {"number": 22, "name": "Tom Heaton"},
            {"number": 37, "name": "Kobbie Mainoo"}
        ]
    }',
    'admin',
    NOW()
);

INSERT INTO matches (
    match_date,
    opponent,
    venue,
    formation,
    score_united,
    score_opponent,
    possession,
    shots,
    shots_on_target,
    passes,
    pass_accuracy,
    fouls,
    yellow_cards,
    red_cards,
    corners,
    offsides,
    match_image,
    match_description,
    lineup_json,
    subs_json,
    added_by,
    date_added
) VALUES (
    '2024-11-24',
    'Ipswich Town',
    'Portman Road',
    '3-4-2-1',
    1,
    1,
    60.0,
    11,
    4,
    649,
    87.0,
    10,
    0,
    0,
    3,
    1,
    '',
    'United drew 1-1 with Ipswich Town at Portman Road. Marcus Rashford opened the scoring in the 2nd minute, but Omari Hutchinson equalized for the hosts in the 43rd minute.',
    '{
        "formation": "3-4-2-1",
        "players": [
            {"number": 24, "name": "A. Onana"},
            {"number": 35, "name": "J. Evans"},
            {"number": 4, "name": "M. de Ligt"},
            {"number": 3, "name": "N. Mazraoui"},
            {"number": 20, "name": "D. Dalot"},
            {"number": 14, "name": "C. Eriksen"},
            {"number": 18, "name": "Casemiro"},
            {"number": 16, "name": "A. Diallo"},
            {"number": 17, "name": "A. Garnacho"},
            {"number": 8, "name": "B. Fernandes"},
            {"number": 10, "name": "M. Rashford"}
        ]
    }',
    '{
        "used": [
            {"number": 7, "name": "Mason Mount"},
            {"number": 9, "name": "Rasmus Hojlund"},
            {"number": 11, "name": "Joshua Zirkzee"},
            {"number": 23, "name": "Luke Shaw"},
            {"number": 25, "name": "Manuel Ugarte"}
        ],
        "unused": [
            {"number": 1, "name": "Altay Bayindir"},
            {"number": 12, "name": "Tyrell Malacia"},
            {"number": 21, "name": "Antony"},
            {"number": 37, "name": "Kobbie Mainoo"}
        ]
    }',
    'admin',
    NOW()
);

INSERT INTO matches (
    match_date,
    opponent,
    venue,
    formation,
    score_united,
    score_opponent,
    possession,
    shots,
    shots_on_target,
    passes,
    pass_accuracy,
    fouls,
    yellow_cards,
    red_cards,
    corners,
    offsides,
    match_image,
    match_description,
    lineup_json,
    subs_json,
    added_by,
    date_added
) VALUES (
    '2024-11-10',
    'Leicester City',
    'Old Trafford',
    '4-2-3-1',
    3,
    0,
    52.0,
    13,
    3,
    491,
    85.0,
    9,
    0,
    0,
    1,
    1,
    '',
    'United secured a comfortable 3-0 victory over Leicester City at Old Trafford. Bruno Fernandes (17\'), Victor Kristiansen (38\' OG), and Alejandro Garnacho (82\') scored for United.',
    '{
        "formation": "4-2-3-1",
        "players": [
            {"number": 24, "name": "A. Onana"},
            {"number": 20, "name": "D. Dalot"},
            {"number": 4, "name": "M. de Ligt"},
            {"number": 6, "name": "L. Martinez"},
            {"number": 3, "name": "N. Mazraoui"},
            {"number": 18, "name": "Casemiro"},
            {"number": 25, "name": "M. Ugarte"},
            {"number": 16, "name": "A. Diallo"},
            {"number": 8, "name": "B. Fernandes"},
            {"number": 10, "name": "M. Rashford"},
            {"number": 9, "name": "R. Hojlund"}
        ]
    }',
    '{
        "used": [
            {"number": 11, "name": "Joshua Zirkzee"},
            {"number": 14, "name": "Christian Eriksen"},
            {"number": 17, "name": "Alejandro Garnacho"},
            {"number": 35, "name": "Jonny Evans"}
        ],
        "unused": [
            {"number": 1, "name": "Altay Bayindir"},
            {"number": 2, "name": "Victor Lindelof"},
            {"number": 7, "name": "Mason Mount"},
            {"number": 21, "name": "Antony"},
            {"number": 22, "name": "Tom Heaton"}
        ]
    }',
    'admin',
    NOW()
);

INSERT INTO matches (
    match_date,
    opponent,
    venue,
    formation,
    score_united,
    score_opponent,
    possession,
    shots,
    shots_on_target,
    passes,
    pass_accuracy,
    fouls,
    yellow_cards,
    red_cards,
    corners,
    offsides,
    match_image,
    match_description,
    lineup_json,
    subs_json,
    added_by,
    date_added
) VALUES (
    '2024-11-03',
    'PAOK',
    'Old Trafford',
    '4-2-3-1',
    2,
    0,
    53.0,
    16,
    4,
    519,
    83.0,
    10,
    2,
    0,
    9,
    1,
    '',
    'United secured a comfortable 2-0 victory against PAOK in the Europa League at Old Trafford, maintaining dominance with 53% possession and creating numerous chances with 16 shots.',
    '{
        "formation": "4-2-3-1",
        "players": [
            {"number": 24, "name": "A. Onana"},
            {"number": 3, "name": "N. Mazraoui"},
            {"number": 2, "name": "V. Lindelof"},
            {"number": 35, "name": "J. Evans"},
            {"number": 20, "name": "D. Dalot"},
            {"number": 18, "name": "Casemiro"},
            {"number": 25, "name": "M. Ugarte"},
            {"number": 16, "name": "A. Diallo"},
            {"number": 8, "name": "B. Fernandes"},
            {"number": 17, "name": "A. Garnacho"},
            {"number": 9, "name": "R. Hojlund"}
        ]
    }',
    '{
        "used": [
            {"number": 6, "name": "Leandro Martinez"},
            {"number": 7, "name": "Mason Mount"},
            {"number": 10, "name": "Marcus Rashford"},
            {"number": 11, "name": "Joshua Zirkzee"},
            {"number": 14, "name": "Christian Eriksen"}
        ],
        "unused": [
            {"number": 1, "name": "Altay Bayindir"},
            {"number": 4, "name": "Matthijs de Ligt"},
            {"number": 21, "name": "Antony"},
            {"number": 22, "name": "Tom Heaton"},
            {"number": 36, "name": "Ethan Wheatley"},
            {"number": 41, "name": "Harry Amass"},
            {"number": 75, "name": "Jayce Fitzgerald"}
        ]
    }',
    'admin',
    NOW()
);

INSERT INTO matches (
    match_date,
    opponent,
    venue,
    formation,
    score_united,
    score_opponent,
    possession,
    shots,
    shots_on_target,
    passes,
    pass_accuracy,
    fouls,
    yellow_cards,
    red_cards,
    corners,
    offsides,
    match_image,
    match_description,
    lineup_json,
    subs_json,
    added_by,
    date_added
) VALUES (
    '2024-11-03',
    'Chelsea',
    'Old Trafford',
    '4-2-3-1',
    1,
    1,
    46.0,
    11,
    4,
    405,
    79.0,
    19,
    6,
    0,
    4,
    4,
    '',
    'A hard-fought 1-1 draw at Old Trafford. Bruno Fernandes scored from the penalty spot (70\') before Moises Caicedo equalized for Chelsea (74\').',
    '{
        "formation": "4-2-3-1",
        "players": [
            {"number": 24, "name": "A. Onana"},
            {"number": 20, "name": "D. Dalot"},
            {"number": 4, "name": "M. de Ligt"},
            {"number": 6, "name": "L. Martinez"},
            {"number": 3, "name": "N. Mazraoui"},
            {"number": 18, "name": "Casemiro"},
            {"number": 25, "name": "M. Ugarte"},
            {"number": 17, "name": "A. Garnacho"},
            {"number": 8, "name": "B. Fernandes"},
            {"number": 10, "name": "M. Rashford"},
            {"number": 9, "name": "R. Hojlund"}
        ]
    }',
    '{
        "used": [
            {"number": 2, "name": "Victor Lindelof"},
            {"number": 11, "name": "Joshua Zirkzee"},
            {"number": 16, "name": "Amad Diallo"}
        ],
        "unused": [
            {"number": 1, "name": "Altay Bayindir"},
            {"number": 35, "name": "Jonny Evans"},
            {"number": 36, "name": "Ethan Wheatley"},
            {"number": 41, "name": "Harry Amass"},
            {"number": 57, "name": "Jack Fletcher"},
            {"number": 75, "name": "Jayce Fitzgerald"}
        ]
    }',
    'admin',
    NOW()
);

INSERT INTO matches (
    match_date,
    opponent,
    venue,
    formation,
    score_united,
    score_opponent,
    possession,
    shots,
    shots_on_target,
    passes,
    pass_accuracy,
    fouls,
    yellow_cards,
    red_cards,
    corners,
    offsides,
    match_image,
    match_description,
    lineup_json,
    subs_json,
    added_by,
    date_added
) VALUES (
    '2024-10-30',
    'Leicester City',
    'Old Trafford',
    '4-2-3-1',
    5,
    2,
    57.0,
    23,
    9,
    560,
    87.0,
    8,
    0,
    0,
    5,
    3,
    '',
    'Impressive 5-2 victory in EFL Cup Round of 16. Casemiro (15\', 39\'), Alejandro Garnacho (26\') and Bruno Fernandes (39\', 59\') scored for United, while Bilal El Khannouss (33\') and Conor Coady (45\'+3) replied for Leicester.',
    '{
        "formation": "4-2-3-1",
        "players": [
            {"number": 1, "name": "A. Bayindir"},
            {"number": 20, "name": "D. Dalot"},
            {"number": 4, "name": "M. de Ligt"},
            {"number": 2, "name": "V. Lindelof"},
            {"number": 6, "name": "L. Martinez"},
            {"number": 25, "name": "M. Ugarte"},
            {"number": 18, "name": "Casemiro"},
            {"number": 10, "name": "M. Rashford"},
            {"number": 8, "name": "B. Fernandes"},
            {"number": 17, "name": "A. Garnacho"},
            {"number": 11, "name": "J. Zirkzee"}
        ]
    }',
    '{
        "used": [
            {"number": 3, "name": "Noussair Mazraoui"},
            {"number": 9, "name": "Rasmus Hojlund"},
            {"number": 16, "name": "Amad Diallo"},
            {"number": 35, "name": "Jonny Evans"},
            {"number": 36, "name": "Ethan Wheatley"}
        ],
        "unused": [
            {"number": 22, "name": "Tom Heaton"},
            {"number": 41, "name": "Harry Amass"},
            {"number": 57, "name": "Jack Fletcher"},
            {"number": 75, "name": "Jayce Fitzgerald"}
        ]
    }',
    'admin',
    NOW()
);

INSERT INTO matches (
    match_date,
    opponent,
    venue,
    formation,
    score_united,
    score_opponent,
    possession,
    shots,
    shots_on_target,
    passes,
    pass_accuracy,
    fouls,
    yellow_cards,
    red_cards,
    corners,
    offsides,
    match_image,
    match_description,
    lineup_json,
    subs_json,
    added_by,
    date_added
) VALUES (
    '2024-10-27',
    'West Ham',
    'London Stadium',
    '4-2-3-1',
    1,
    2,
    58.0,
    18,
    5,
    538,
    83.0,
    7,
    1,
    0,
    5,
    3,
    '',
    'United fell to a 2-1 defeat at West Ham. Casemiro scored in the 81st minute, but goals from Crysenscio Summerville (74\') and Jarrod Bowen (90\'+2 P) secured the win for the hosts.',
    '{
        "formation": "4-2-3-1",
        "players": [
            {"number": 24, "name": "A. Onana"},
            {"number": 3, "name": "N. Mazraoui"},
            {"number": 6, "name": "L. Martinez"},
            {"number": 4, "name": "M. de Ligt"},
            {"number": 20, "name": "D. Dalot"},
            {"number": 18, "name": "Casemiro"},
            {"number": 14, "name": "C. Eriksen"},
            {"number": 17, "name": "A. Garnacho"},
            {"number": 8, "name": "B. Fernandes"},
            {"number": 10, "name": "M. Rashford"},
            {"number": 9, "name": "R. Hojlund"}
        ]
    }',
    '{
        "used": [
            {"number": 2, "name": "Victor Lindelof"},
            {"number": 11, "name": "Joshua Zirkzee"},
            {"number": 16, "name": "Amad Diallo"}
        ],
        "unused": [
            {"number": 1, "name": "Altay Bayindir"},
            {"number": 25, "name": "Manuel Ugarte"},
            {"number": 35, "name": "Jonny Evans"},
            {"number": 36, "name": "Ethan Wheatley"},
            {"number": 41, "name": "Harry Amass"},
            {"number": 57, "name": "Jack Fletcher"}
        ]
    }',
    'admin',
    NOW()
);

INSERT INTO matches (
    match_date,
    opponent,
    venue,
    formation,
    score_united,
    score_opponent,
    possession,
    shots,
    shots_on_target,
    passes,
    pass_accuracy,
    fouls,
    yellow_cards,
    red_cards,
    corners,
    offsides,
    match_image,
    match_description,
    lineup_json,
    subs_json,
    added_by,
    date_added
) VALUES (
    '2024-10-24',
    'Fenerbahce',
    'Sukru Saracoglu',
    '4-2-3-1',
    1,
    1,
    48.0,
    12,
    5,
    459,
    84.0,
    14,
    1,
    0,
    3,
    1,
    '',
    'Manchester United drew 1-1 with Fenerbahce at the Sukru Saracoglu Stadium.',
    '{
        "formation": "4-2-3-1",
        "players": [
            {"number": 24, "name": "A. Onana"},
            {"number": 6, "name": "L. Martinez"},
            {"number": 2, "name": "V. Lindelof"},
            {"number": 4, "name": "M. de Ligt"},
            {"number": 20, "name": "D. Dalot"},
            {"number": 25, "name": "M. Ugarte"},
            {"number": 14, "name": "C. Eriksen"},
            {"number": 3, "name": "N. Mazraoui"},
            {"number": 11, "name": "J. Zirkzee"},
            {"number": 10, "name": "M. Rashford"},
            {"number": 17, "name": "A. Garnacho"}
        ]
    }',
    '{
        "used": [
            {"number": 9, "name": "Rasmus Hojlund"},
            {"number": 16, "name": "Amad Diallo"},
            {"number": 18, "name": "Casemiro"},
            {"number": 21, "name": "Antony"}
        ],
        "unused": [
            {"number": 1, "name": "Altay Bayindir"},
            {"number": 22, "name": "Tom Heaton"},
            {"number": 36, "name": "Ethan Wheatley"},
            {"number": 41, "name": "Harry Amass"},
            {"number": 66, "name": "Habeeb Ogunneye"}
        ]
    }',
    'admin',
    NOW()
);

INSERT INTO matches (
    match_date,
    opponent,
    venue,
    formation,
    score_united,
    score_opponent,
    possession,
    shots,
    shots_on_target,
    passes,
    pass_accuracy,
    fouls,
    yellow_cards,
    red_cards,
    corners,
    offsides,
    match_image,
    match_description,
    lineup_json,
    subs_json,
    added_by,
    date_added
) VALUES (
    '2024-10-19',
    'Brentford',
    'Old Trafford',
    '4-2-3-1',
    2,
    1,
    51.0,
    23,
    11,
    488,
    83.0,
    4,
    2,
    0,
    9,
    1,
    '',
    'Manchester United secured a 2-1 victory over Brentford at Old Trafford. Alejandro Garnacho scored in the 47th minute, followed by Rasmus Hojlund in the 62nd minute. Ethan Pinnock scored for Brentford in the 45th minute.',
    '{
        "formation": "4-2-3-1",
        "players": [
            {"number": 24, "name": "A. Onana"},
            {"number": 20, "name": "D. Dalot"},
            {"number": 4, "name": "M. de Ligt"},
            {"number": 35, "name": "J. Evans"},
            {"number": 6, "name": "L. Martinez"},
            {"number": 14, "name": "C. Eriksen"},
            {"number": 18, "name": "Casemiro"},
            {"number": 10, "name": "M. Rashford"},
            {"number": 8, "name": "B. Fernandes"},
            {"number": 17, "name": "A. Garnacho"},
            {"number": 9, "name": "R. Hojlund"}
        ]
    }',
    '{
        "used": [
            {"number": 2, "name": "Victor Lindelof"},
            {"number": 3, "name": "Noussair Mazraoui"},
            {"number": 11, "name": "Joshua Zirkzee"},
            {"number": 25, "name": "Manuel Ugarte"}
        ],
        "unused": [
            {"number": 1, "name": "Altay Bayindir"},
            {"number": 16, "name": "Amad Diallo"},
            {"number": 21, "name": "Antony"},
            {"number": 36, "name": "Ethan Wheatley"},
            {"number": 57, "name": "Jack Fletcher"}
        ]
    }',
    'admin',
    NOW()
);

INSERT INTO matches (
    match_date,
    opponent,
    venue,
    formation,
    score_united,
    score_opponent,
    possession,
    shots,
    shots_on_target,
    passes,
    pass_accuracy,
    fouls,
    yellow_cards,
    red_cards,
    corners,
    offsides,
    match_image,
    match_description,
    lineup_json,
    subs_json,
    added_by,
    date_added
) VALUES (
    '2024-10-06',
    'Aston Villa',
    'Villa Park',
    '4-2-3-1',
    0,
    0,
    46.0,
    10,
    4,
    369,
    81.0,
    11,
    5,
    0,
    3,
    1,
    '',
    'Manchester United drew 0-0 with Aston Villa at Villa Park in a closely contested match.',
    '{
        "formation": "4-2-3-1",
        "players": [
            {"number": 24, "name": "A. Onana"},
            {"number": 20, "name": "D. Dalot"},
            {"number": 35, "name": "J. Evans"},
            {"number": 5, "name": "H. Maguire"},
            {"number": 3, "name": "N. Mazraoui"},
            {"number": 14, "name": "C. Eriksen"},
            {"number": 37, "name": "K. Mainoo"},
            {"number": 10, "name": "M. Rashford"},
            {"number": 8, "name": "B. Fernandes"},
            {"number": 17, "name": "A. Garnacho"},
            {"number": 9, "name": "R. Hojlund"}
        ]
    }',
    '{
        "used": [
            {"number": 2, "name": "Victor Lindelof"},
            {"number": 4, "name": "Matthijs de Ligt"},
            {"number": 11, "name": "Joshua Zirkzee"},
            {"number": 18, "name": "Casemiro"},
            {"number": 21, "name": "Antony"}
        ],
        "unused": [
            {"number": 1, "name": "Altay Bayindir"},
            {"number": 6, "name": "Leandro Martinez"},
            {"number": 16, "name": "Amad Diallo"},
            {"number": 25, "name": "Manuel Ugarte"}
        ]
    }',
    'admin',
    NOW()
);

INSERT INTO matches (
    match_date,
    opponent,
    venue,
    formation,
    score_united,
    score_opponent,
    possession,
    shots,
    shots_on_target,
    passes,
    pass_accuracy,
    fouls,
    yellow_cards,
    red_cards,
    corners,
    offsides,
    match_image,
    match_description,
    lineup_json,
    subs_json,
    added_by,
    date_added
) VALUES (
    '2024-10-03',
    'Porto',
    'Estadio do Dragao',
    '4-2-3-1',
    3,
    3,
    54.0,
    29,
    8,
    487,
    89.0,
    7,
    0,
    1,
    10,
    1,
    '',
    'Thrilling 3-3 draw in the Europa League with Marcus Rashford (7''), Rasmus Hojlund (20''), and Harry Maguire (90+1'') scoring for United, while Pepe (27'') and Sami Aghebhowa (34'', 50'') netted for Porto. Bruno Fernandes received a red card in the 81st minute.',
    '{
        "formation": "4-2-3-1",
        "players": [
            {"number": 24, "name": "A. Onana"},
            {"number": 20, "name": "D. Dalot"},
            {"number": 6, "name": "L. Martinez"},
            {"number": 4, "name": "M. de Ligt"},
            {"number": 3, "name": "N. Mazraoui"},
            {"number": 14, "name": "C. Eriksen"},
            {"number": 18, "name": "Casemiro"},
            {"number": 10, "name": "M. Rashford"},
            {"number": 8, "name": "B. Fernandes"},
            {"number": 16, "name": "A. Diallo"},
            {"number": 9, "name": "R. Hojlund"}
        ]
    }',
    '{
        "used": [
            {"number": 5, "name": "Harry Maguire"},
            {"number": 11, "name": "Joshua Zirkzee"},
            {"number": 17, "name": "Alejandro Garnacho"},
            {"number": 21, "name": "Antony"},
            {"number": 35, "name": "Jonny Evans"}
        ],
        "unused": [
            {"number": 1, "name": "Altay Bayindir"},
            {"number": 2, "name": "Victor Lindelof"},
            {"number": 22, "name": "Tom Heaton"},
            {"number": 25, "name": "Manuel Ugarte"},
            {"number": 43, "name": "Toby Collyer"},
            {"number": 44, "name": "Daniel Gore"}
        ]
    }',
    'admin',
    NOW()
);

INSERT INTO matches (
    match_date,
    opponent,
    venue,
    formation,
    score_united,
    score_opponent,
    possession,
    shots,
    shots_on_target,
    passes,
    pass_accuracy,
    fouls,
    yellow_cards,
    red_cards,
    corners,
    offsides,
    match_image,
    match_description,
    lineup_json,
    subs_json,
    added_by,
    date_added
) VALUES (
    '2024-09-29',
    'Tottenham',
    'Old Trafford',
    '4-2-3-1',
    0,
    3,
    39.0,
    11,
    2,
    395,
    78.0,
    16,
    5,
    1,
    5,
    2,
    '',
    'United suffered a 3-0 home defeat to Tottenham. Brennan Johnson (3''), Dejan Kulusevski (47''), and Dominic Solanke (77'') scored for Spurs. Bruno Fernandes was sent off in the 42nd minute.',
    '{
        "formation": "4-2-3-1",
        "players": [
            {"number": 24, "name": "A. Onana"},
            {"number": 3, "name": "N. Mazraoui"},
            {"number": 4, "name": "M. de Ligt"},
            {"number": 6, "name": "L. Martinez"},
            {"number": 20, "name": "D. Dalot"},
            {"number": 37, "name": "K. Mainoo"},
            {"number": 25, "name": "M. Ugarte"},
            {"number": 17, "name": "A. Garnacho"},
            {"number": 8, "name": "B. Fernandes"},
            {"number": 10, "name": "M. Rashford"},
            {"number": 11, "name": "J. Zirkzee"}
        ]
    }',
    '{
        "used": [
            {"number": 7, "name": "Mason Mount"},
            {"number": 9, "name": "Rasmus Hojlund"},
            {"number": 14, "name": "Christian Eriksen"},
            {"number": 16, "name": "Amad Diallo"},
            {"number": 18, "name": "Casemiro"}
        ],
        "unused": [
            {"number": 1, "name": "Altay Bayindir"},
            {"number": 2, "name": "Victor Lindelof"},
            {"number": 21, "name": "Antony"},
            {"number": 35, "name": "Jonny Evans"}
        ]
    }',
    'admin',
    NOW()
);

INSERT INTO matches (
    match_date,
    opponent,
    venue,
    formation,
    score_united,
    score_opponent,
    possession,
    shots,
    shots_on_target,
    passes,
    pass_accuracy,
    fouls,
    yellow_cards,
    red_cards,
    corners,
    offsides,
    match_image,
    match_description,
    lineup_json,
    subs_json,
    added_by,
    date_added
) VALUES (
    '2024-09-25',
    'Twente',
    'Old Trafford',
    '4-2-3-1',
    1,
    1,
    57.0,
    19,
    5,
    539,
    86.0,
    5,
    1,
    0,
    10,
    2,
    '',
    'Christian Eriksen opened the scoring in the 35th minute, but Sam Lammers equalized for Twente in the 68th minute in this Europa League group stage match.',
    '{
        "formation": "4-2-3-1",
        "players": [
            {"number": 24, "name": "A. Onana"},
            {"number": 3, "name": "N. Mazraoui"},
            {"number": 5, "name": "H. Maguire"},
            {"number": 6, "name": "L. Martinez"},
            {"number": 20, "name": "D. Dalot"},
            {"number": 25, "name": "M. Ugarte"},
            {"number": 14, "name": "C. Eriksen"},
            {"number": 16, "name": "A. Diallo"},
            {"number": 8, "name": "B. Fernandes"},
            {"number": 10, "name": "M. Rashford"},
            {"number": 11, "name": "J. Zirkzee"}
        ]
    }',
    '{
        "used": [
            {"number": 7, "name": "Mason Mount"},
            {"number": 9, "name": "Rasmus Hojlund"},
            {"number": 17, "name": "Alejandro Garnacho"},
            {"number": 37, "name": "Kobbie Mainoo"}
        ],
        "unused": [
            {"number": 1, "name": "Altay Bayindir"},
            {"number": 4, "name": "Matthijs de Ligt"},
            {"number": 18, "name": "Casemiro"},
            {"number": 21, "name": "Antony"},
            {"number": 22, "name": "Tom Heaton"},
            {"number": 35, "name": "Jonny Evans"},
            {"number": 43, "name": "Toby Collyer"}
        ]
    }',
    'admin',
    NOW()
);

INSERT INTO matches (
    match_date,
    opponent,
    venue,
    formation,
    score_united,
    score_opponent,
    possession,
    shots,
    shots_on_target,
    passes,
    pass_accuracy,
    fouls,
    yellow_cards,
    red_cards,
    corners,
    offsides,
    match_image,
    match_description,
    lineup_json,
    subs_json,
    added_by,
    date_added
) VALUES (
    '2024-09-21',
    'Crystal Palace',
    'Selhurst Park',
    '4-2-3-1',
    0,
    0,
    67.0,
    15,
    6,
    639,
    85.0,
    12,
    2,
    0,
    11,
    0,
    '',
    'Manchester United and Crystal Palace played out a goalless draw at Selhurst Park.',
    '{
        "formation": "4-2-3-1",
        "players": [
            {"number": 24, "name": "A. Onana"},
            {"number": 20, "name": "D. Dalot"},
            {"number": 6, "name": "L. Martinez"},
            {"number": 4, "name": "M. de Ligt"},
            {"number": 3, "name": "N. Mazraoui"},
            {"number": 14, "name": "C. Eriksen"},
            {"number": 37, "name": "K. Mainoo"},
            {"number": 17, "name": "A. Garnacho"},
            {"number": 8, "name": "B. Fernandes"},
            {"number": 16, "name": "A. Diallo"},
            {"number": 11, "name": "J. Zirkzee"}
        ]
    }',
    '{
        "used": [
            {"number": 9, "name": "Rasmus Hojlund"},
            {"number": 10, "name": "Marcus Rashford"},
            {"number": 25, "name": "Manuel Ugarte"}
        ],
        "unused": [
            {"number": 1, "name": "Altay Bayindir"},
            {"number": 5, "name": "Harry Maguire"},
            {"number": 7, "name": "Mason Mount"},
            {"number": 18, "name": "Casemiro"},
            {"number": 21, "name": "Antony"},
            {"number": 35, "name": "Jonny Evans"}
        ]
    }',
    'admin',
    NOW()
);

INSERT INTO matches (
    match_date,
    opponent,
    venue,
    formation,
    score_united,
    score_opponent,
    possession,
    shots,
    shots_on_target,
    passes,
    pass_accuracy,
    fouls,
    yellow_cards,
    red_cards,
    corners,
    offsides,
    match_image,
    match_description,
    lineup_json,
    subs_json,
    added_by,
    date_added
) VALUES (
    '2024-09-17',
    'Barnsley',
    'Old Trafford',
    '4-2-3-1',
    7,
    0,
    66.0,
    26,
    13,
    636,
    88.0,
    16,
    0,
    0,
    3,
    2,
    '',
    'A dominant performance in the EFL Cup third round, with Marcus Rashford (16'', 57''), Antony (35''), Alejandro Garnacho (45+2'', 49'') and Christian Eriksen (81'', 85'') scoring for United.',
    '{
        "formation": "4-2-3-1",
        "players": [
            {"number": 1, "name": "A. Bayindir"},
            {"number": 20, "name": "D. Dalot"},
            {"number": 5, "name": "H. Maguire"},
            {"number": 35, "name": "J. Evans"},
            {"number": 43, "name": "T. Collyer"},
            {"number": 18, "name": "Casemiro"},
            {"number": 25, "name": "M. Ugarte"},
            {"number": 21, "name": "Antony"},
            {"number": 14, "name": "C. Eriksen"},
            {"number": 17, "name": "A. Garnacho"},
            {"number": 10, "name": "M. Rashford"}
        ]
    }',
    '{
        "used": [
            {"number": 3, "name": "Noussair Mazraoui"},
            {"number": 4, "name": "Matthijs de Ligt"},
            {"number": 8, "name": "Bruno Fernandes"},
            {"number": 11, "name": "Joshua Zirkzee"},
            {"number": 16, "name": "Amad Diallo"}
        ],
        "unused": [
            {"number": 6, "name": "Lisandro Martinez"},
            {"number": 22, "name": "Tom Heaton"},
            {"number": 36, "name": "Ethan Wheatley"},
            {"number": 37, "name": "Kobbie Mainoo"}
        ]
    }',
    'admin',
    NOW()
);

INSERT INTO matches (
   match_date,
   opponent,
   venue,
   formation,
   score_united,
   score_opponent,
   possession,
   shots,
   shots_on_target,
   passes,
   pass_accuracy,
   fouls,
   yellow_cards,
   red_cards,
   corners,
   offsides,
   match_image,
   match_description,
   lineup_json,
   subs_json,
   added_by,
   date_added
) VALUES (
   '2024-09-14',
   'Southampton',
   'St Marys Stadium',
   '4-2-3-1',
   3,
   0,
   56.0,
   20,
   10,
   611,
   90.0,
   14,
   4,
   0,
   7,
   0,
   '',
   'United secured a 3-0 away victory with goals from Matthijs de Ligt (35''), Marcus Rashford (41'') and Alejandro Garnacho (90+1''). Jack Stephens was sent off for Southampton in the 79th minute.',
   '{
       "formation": "4-2-3-1",
       "players": [
           {"number": 24, "name": "A. Onana"},
           {"number": 20, "name": "D. Dalot"},
           {"number": 6, "name": "L. Martinez"},
           {"number": 4, "name": "M. de Ligt"},
           {"number": 3, "name": "N. Mazraoui"},
           {"number": 37, "name": "K. Mainoo"},
           {"number": 14, "name": "C. Eriksen"},
           {"number": 10, "name": "M. Rashford"},
           {"number": 8, "name": "B. Fernandes"},
           {"number": 16, "name": "A. Diallo"},
           {"number": 11, "name": "J. Zirkzee"}
       ]
   }',
   '{
       "used": [
           {"number": 5, "name": "H. Maguire"},
           {"number": 17, "name": "A. Garnacho"},
           {"number": 18, "name": "Casemiro"},
           {"number": 25, "name": "M. Ugarte"},
           {"number": 35, "name": "J. Evans"}
       ],
       "unused": [
           {"number": 1, "name": "A. Bayindir"},
           {"number": 21, "name": "Antony"},
           {"number": 36, "name": "E. Wheatley"},
           {"number": 43, "name": "T. Collyer"}
       ]
   }',
   'admin',
   NOW()
);

INSERT INTO matches (
   match_date,
   opponent,
   venue,
   formation,
   score_united,
   score_opponent,
   possession,
   shots,
   shots_on_target,
   passes,
   pass_accuracy,
   fouls,
   yellow_cards,
   red_cards,
   corners,
   offsides,
   match_image,
   match_description,
   lineup_json,
   subs_json,
   added_by,
   date_added
) VALUES (
   '2024-09-01',
   'Liverpool',
   'Old Trafford',
   '4-2-3-1',
   0,
   3,
   53.0,
   8,
   3,
   507,
   83.0,
   7,
   4,
   0,
   5,
   0,
   '',
   'United suffered a 3-0 home defeat to Liverpool, with Luis Diaz (35'') and Mohamed Salah (56'') scoring for the visitors.',
   '{
       "formation": "4-2-3-1",
       "players": [
           {"number": 24, "name": "A. Onana"},
           {"number": 3, "name": "N. Mazraoui"},
           {"number": 4, "name": "M. de Ligt"},
           {"number": 6, "name": "L. Martinez"},
           {"number": 20, "name": "D. Dalot"},
           {"number": 18, "name": "Casemiro"},
           {"number": 37, "name": "K. Mainoo"},
           {"number": 17, "name": "A. Garnacho"},
           {"number": 8, "name": "B. Fernandes"},
           {"number": 10, "name": "M. Rashford"},
           {"number": 11, "name": "J. Zirkzee"}
       ]
   }',
   '{
       "used": [
           {"number": 5, "name": "H. Maguire"},
           {"number": 14, "name": "C. Eriksen"},
           {"number": 16, "name": "A. Diallo"},
           {"number": 43, "name": "T. Collyer"}
       ],
       "unused": [
           {"number": 1, "name": "A. Bayindir"},
           {"number": 21, "name": "Antony"},
           {"number": 22, "name": "T. Heaton"},
           {"number": 35, "name": "J. Evans"},
           {"number": 36, "name": "E. Wheatley"}
       ]
   }',
   'admin',
   NOW()
);

INSERT INTO matches (
   match_date,
   opponent,
   venue,
   formation,
   score_united,
   score_opponent,
   possession,
   shots,
   shots_on_target,
   passes,
   pass_accuracy,
   fouls,
   yellow_cards,
   red_cards,
   corners,
   offsides,
   match_image,
   match_description,
   lineup_json,
   subs_json,
   added_by,
   date_added
) VALUES (
   '2024-08-24',
   'Brighton',
   'Falmer Stadium',
   '4-2-3-1',
   1,
   2,
   52.0,
   11,
   4,
   511,
   87.0,
   13,
   2,
   0,
   4,
   6,
   '',
   'United fell to a 2-1 defeat at Brighton with Danny Welbeck (32'') and Joao Pedro (90+5'') scoring for the hosts, while Amad Diallo (60'') got United''s consolation goal.',
   '{
       "formation": "4-2-3-1",
       "players": [
           {"number": 24, "name": "A. Onana"},
           {"number": 20, "name": "D. Dalot"},
           {"number": 6, "name": "L. Martinez"},
           {"number": 5, "name": "H. Maguire"},
           {"number": 3, "name": "N. Mazraoui"},
           {"number": 37, "name": "K. Mainoo"},
           {"number": 18, "name": "Casemiro"},
           {"number": 10, "name": "M. Rashford"},
           {"number": 7, "name": "M. Mount"},
           {"number": 16, "name": "A. Diallo"},
           {"number": 8, "name": "B. Fernandes"}
       ]
   }',
   '{
       "used": [
           {"number": 4, "name": "M. de Ligt"},
           {"number": 11, "name": "J. Zirkzee"},
           {"number": 17, "name": "A. Garnacho"},
           {"number": 21, "name": "Antony"},
           {"number": 39, "name": "S. McTominay"}
       ],
       "unused": [
           {"number": 1, "name": "A. Bayindir"},
           {"number": 14, "name": "C. Eriksen"},
           {"number": 35, "name": "J. Evans"},
           {"number": 43, "name": "T. Collyer"}
       ]
   }',
   'admin',
   NOW()
);

INSERT INTO matches (
   match_date,
   opponent,
   venue,
   formation,
   score_united,
   score_opponent,
   possession,
   shots,
   shots_on_target,
   passes,
   pass_accuracy,
   fouls,
   yellow_cards,
   red_cards,
   corners,
   offsides,
   match_image,
   match_description,
   lineup_json,
   subs_json,
   added_by,
   date_added
) VALUES (
   '2024-08-16',
   'Fulham',
   'Old Trafford',
   '4-2-3-1',
   1,
   0,
   56.0,
   14,
   5,
   482,
   84.0,
   12,
   2,
   0,
   7,
   3,
   '',
   'Joshua Zirkzee scored the only goal in the 87th minute to secure a 1-0 victory for United at Old Trafford.',
   '{
       "formation": "4-2-3-1",
       "players": [
           {"number": 24, "name": "A. Onana"},
           {"number": 3, "name": "N. Mazraoui"},
           {"number": 5, "name": "H. Maguire"},
           {"number": 6, "name": "L. Martinez"},
           {"number": 20, "name": "D. Dalot"},
           {"number": 18, "name": "Casemiro"},
           {"number": 37, "name": "K. Mainoo"},
           {"number": 16, "name": "A. Diallo"},
           {"number": 7, "name": "M. Mount"},
           {"number": 10, "name": "M. Rashford"},
           {"number": 8, "name": "B. Fernandes"}
       ]
   }',
   '{
       "used": [
           {"number": 4, "name": "M. de Ligt"},
           {"number": 11, "name": "J. Zirkzee"},
           {"number": 17, "name": "A. Garnacho"},
           {"number": 35, "name": "J. Evans"},
           {"number": 39, "name": "S. McTominay"}
       ],
       "unused": [
           {"number": 1, "name": "A. Bayindir"},
           {"number": 14, "name": "C. Eriksen"},
           {"number": 21, "name": "Antony"},
           {"number": 43, "name": "T. Collyer"}
       ]
   }',
   'admin',
   NOW()
);

INSERT INTO matches (
   match_date,
   opponent,
   venue,
   formation,
   score_united,
   score_opponent,
   possession,
   shots,
   shots_on_target,
   passes,
   pass_accuracy,
   fouls,
   yellow_cards,
   red_cards,
   corners,
   offsides,
   match_image,
   match_description,
   lineup_json,
   subs_json,
   added_by,
   date_added
) VALUES (
   '2024-08-10',
   'Manchester City',
   'Wembley Stadium',
   '4-2-3-1',
   1,
   1,
   44.0,
   8,
   2,
   399,
   85.0,
   9,
   1,
   0,
   2,
   3,
   '',
   'FA Community Shield ended 1-1 after 90 minutes with Bernardo Silva (89'') and Alejandro Garnacho (82'') scoring, before City won 7-6 on penalties.',
   '{
       "formation": "4-2-3-1",
       "players": [
           {"number": 24, "name": "A. Onana"},
           {"number": 20, "name": "D. Dalot"},
           {"number": 5, "name": "H. Maguire"},
           {"number": 6, "name": "L. Martinez"},
           {"number": 35, "name": "J. Evans"},
           {"number": 37, "name": "K. Mainoo"},
           {"number": 18, "name": "Casemiro"},
           {"number": 10, "name": "M. Rashford"},
           {"number": 7, "name": "M. Mount"},
           {"number": 16, "name": "A. Diallo"},
           {"number": 8, "name": "B. Fernandes"}
       ]
   }',
   '{
       "used": [
           {"number": 17, "name": "A. Garnacho"},
           {"number": 25, "name": "J. Sancho"},
           {"number": 28, "name": "F. Pellistri"},
           {"number": 39, "name": "S. McTominay"},
           {"number": 43, "name": "T. Collyer"}
       ],
       "unused": [
           {"number": 1, "name": "A. Bayindir"},
           {"number": 11, "name": "J. Zirkzee"},
           {"number": 14, "name": "C. Eriksen"},
           {"number": 21, "name": "Antony"}
       ]
   }',
   'admin',
   NOW()
);

INSERT INTO matches (
   match_date,
   opponent,
   venue,
   formation,
   score_united,
   score_opponent,
   possession,
   shots,
   shots_on_target,
   passes,
   pass_accuracy,
   fouls,
   yellow_cards,
   red_cards,
   corners,
   offsides,
   match_image,
   match_description,
   lineup_json,
   subs_json,
   added_by,
   date_added
) VALUES (
   '2024-08-03',
   'Liverpool',
   'Williams-Brice Stadium',
   '4-2-3-1',
   0,
   3,
   47.0,
   18,
   8,
   455,
   83.0,
   8,
   1,
   0,
   5,
   2,
   '',
   'United suffered a 3-0 defeat in the club friendly, with Fabio Carvalho (10''), Curtis Jones (38'') and Konstantinos Tsimikas (61'') scoring for Liverpool.',
   '{
       "formation": "4-2-3-1",
       "players": [
           {"number": 24, "name": "A. Onana"},
           {"number": 29, "name": "A. Wan-Bissaka"},
           {"number": 35, "name": "J. Evans"},
           {"number": 2, "name": "V. Lindelof"},
           {"number": 41, "name": "H. Amass"},
           {"number": 18, "name": "Casemiro"},
           {"number": 43, "name": "T. Collyer"},
           {"number": 16, "name": "A. Diallo"},
           {"number": 7, "name": "M. Mount"},
           {"number": 10, "name": "M. Rashford"},
           {"number": 25, "name": "J. Sancho"}
       ]
   }',
   '{
       "used": [
           {"number": 14, "name": "C. Eriksen"},
           {"number": 21, "name": "Antony"},
           {"number": 36, "name": "E. Wheatley"},
           {"number": 39, "name": "S. McTominay"}
       ],
       "unused": [
           {"number": 22, "name": "T. Heaton"},
           {"number": 40, "name": "R. Vitek"},
           {"number": 46, "name": "H. Mejbri"},
           {"number": 57, "name": "J. Fletcher"}
       ]
   }',
   'admin',
   NOW()
);

INSERT INTO matches (
   match_date,
   opponent,
   venue,
   formation,
   score_united,
   score_opponent,
   possession,
   shots,
   shots_on_target,
   passes,
   pass_accuracy,
   fouls,
   yellow_cards,
   red_cards,
   corners,
   offsides,
   match_image,
   match_description,
   lineup_json,
   subs_json,
   added_by,
   date_added
) VALUES (
   '2024-07-31',
   'Real Betis',
   'Snapdragon Stadium',
   '4-2-3-1',
   3,
   2,
   48.0,
   12,
   6,
   449,
   85.0,
   11,
   2,
   0,
   5,
   1,
   '',
   'United won 3-2 with Marcus Rashford (18'' P), Amad Diallo (24'') and Casemiro (31'') scoring for United. Iker Losada (15'') and Diego Lorente (61'') scored for Betis in this club friendly.',
   '{
       "formation": "4-2-3-1",
       "players": [
           {"number": 22, "name": "T. Heaton"},
           {"number": 29, "name": "A. Wan-Bissaka"},
           {"number": 5, "name": "H. Maguire"},
           {"number": 2, "name": "V. Lindelof"},
           {"number": 41, "name": "H. Amass"},
           {"number": 18, "name": "Casemiro"},
           {"number": 14, "name": "C. Eriksen"},
           {"number": 16, "name": "A. Diallo"},
           {"number": 39, "name": "S. McTominay"},
           {"number": 10, "name": "M. Rashford"},
           {"number": 25, "name": "J. Sancho"}
       ]
   }',
   '{
       "used": [
           {"number": 7, "name": "M. Mount"},
           {"number": 21, "name": "Antony"},
           {"number": 35, "name": "J. Evans"},
           {"number": 36, "name": "E. Wheatley"},
           {"number": 43, "name": "T. Collyer"}
       ],
       "unused": [
           {"number": 24, "name": "A. Onana"},
           {"number": 45, "name": "D. Mee"},
           {"number": 57, "name": "J. Fletcher"}
       ]
   }',
   'admin',
   NOW()
);