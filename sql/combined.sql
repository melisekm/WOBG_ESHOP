INSERT INTO public.payments (id, created_at, updated_at, name)
VALUES (DEFAULT, '2021-11-17 14:46:08', '2021-11-17 14:46:08', 'Paypal');

INSERT INTO public.payments (id, created_at, updated_at, name)
VALUES (DEFAULT, '2021-11-17 14:46:15', '2021-11-17 14:46:14', 'Bank Transfer');

INSERT INTO public.payments (id, created_at, updated_at, name)
VALUES (DEFAULT, '2021-11-17 14:46:22', '2021-11-17 14:46:22', 'Card');

INSERT INTO public.shippings (id, created_at, updated_at, name, price)
VALUES (DEFAULT, '2021-11-17 14:45:00', '2021-11-17 14:45:00', 'Standard Delivery', 2.99);

INSERT INTO public.shippings (id, created_at, updated_at, name, price)
VALUES (DEFAULT, '2021-11-17 14:45:17', '2021-11-17 14:45:18', 'UPS Service', 5.49);

INSERT INTO public.shippings (id, created_at, updated_at, name, price)
VALUES (DEFAULT, '2021-11-17 14:45:28', '2021-11-17 14:45:28', 'Parcel Service', 4.99);

INSERT INTO public.product_categories (id, created_at, updated_at, name)
VALUES (DEFAULT, '2021-11-13 20:55:14', '2021-11-13 20:55:18', 'Family Games');

INSERT INTO public.product_categories (id, created_at, updated_at, name)
VALUES (DEFAULT, '2021-11-13 20:56:03', '2021-11-13 20:56:04', 'Children''s Games');

INSERT INTO public.product_categories (id, created_at, updated_at, name)
VALUES (DEFAULT, '2021-11-13 20:56:32', '2021-11-13 20:56:33', 'Party Games');

INSERT INTO public.product_categories (id, created_at, updated_at, name)
VALUES (DEFAULT, '2021-11-13 20:56:42', '2021-11-13 20:56:43', 'Card Games');

INSERT INTO public.product_categories (id, created_at, updated_at, name)
VALUES (DEFAULT, '2021-11-13 20:56:49', '2021-11-13 20:56:50', 'Puzzles');

INSERT INTO public.product_categories (id, created_at, updated_at, name)
VALUES (DEFAULT, '2021-11-13 20:56:56', '2021-11-13 20:56:57', 'Strategic Games');

INSERT INTO public.product_categories (id, created_at, updated_at, name)
VALUES (DEFAULT, '2021-11-13 20:57:24', '2021-11-13 20:57:25', 'Two-Players Games');

INSERT INTO public.product_categories (id, created_at, updated_at, name)
VALUES (DEFAULT, '2021-11-13 20:57:25', '2021-11-13 20:57:26', 'Cooperative Games');

INSERT INTO public.product_categories (id, created_at, updated_at, name)
VALUES (DEFAULT, '2021-11-13 20:57:27', '2021-11-13 20:57:28', 'Quiz, Trivia');

INSERT INTO public.product_sub_categories (id, created_at, updated_at, name)
VALUES (DEFAULT, '2021-11-13 21:01:05', '2021-11-13 21:01:06', 'Animals');

INSERT INTO public.product_sub_categories (id, created_at, updated_at, name)
VALUES (DEFAULT, '2021-11-13 21:01:07', '2021-11-13 21:01:08', 'Adventure');

INSERT INTO public.product_sub_categories (id, created_at, updated_at, name)
VALUES (DEFAULT, '2021-11-13 21:01:08', '2021-11-13 21:01:09', 'Humor');

INSERT INTO public.product_sub_categories (id, created_at, updated_at, name)
VALUES (DEFAULT, '2021-11-13 21:01:09', '2021-11-13 21:01:10', 'Educational');

INSERT INTO public.product_sub_categories (id, created_at, updated_at, name)
VALUES (DEFAULT, '2021-11-13 21:01:11', '2021-11-13 21:01:11', 'Fantasy, Sci-fi, Horror');

INSERT INTO public.product_sub_categories (id, created_at, updated_at, name)
VALUES (DEFAULT, '2021-11-13 21:01:12', '2021-11-13 21:01:12', 'Economic');

INSERT INTO public.product_sub_categories (id, created_at, updated_at, name)
VALUES (DEFAULT, '2021-11-13 21:01:13', '2021-11-13 21:01:14', 'History');

INSERT INTO public.product_sub_categories (id, created_at, updated_at, name)
VALUES (DEFAULT, '2021-11-13 21:01:14', '2021-11-13 21:01:15', 'Deduction');

INSERT INTO public.product_sub_categories (id, created_at, updated_at, name)
VALUES (DEFAULT, '2021-11-13 21:01:14', '2021-11-13 21:01:15', 'Other');

INSERT INTO public.products (id, created_at, updated_at, name, price, publisher, description, includes, language,
                             release_date, min_age, min_play_time, min_players, max_players, product_category_id,
                             product_sub_category_id)
VALUES (DEFAULT, '2021-11-13 21:03:40', '2021-11-13 21:03:41', 'Ticket to Ride: Europe Edition', 37.99,
        'Days of wonder',
        'Ticket to Ride, from Days of Wonder, is one of those ultimately simple yet compelling gateway games that continues to prove its place in the world of board gaming. In Ticket to Ride, 2-5 players compete against each other to earn the most victory points by placing train routes across the United States of America. Points depend on the length of the train route, the longer, the better. Routes are claimed by collecting and playing coloured cards that match the colour of the routes across the map. As the game progresses, the map starts to become crowded and the game can become more cutthroat as players start to cut each other off - or try to. Ticket to Ride is already a classic in gaming that has won endless awards and sold millions of copies worldwide. It''s suitable for newcomers to the hobby and gaming veterans alike.', '1 board map of European train routes
15 colored train stations
240 colored train cars
110 train car cards
46 destination tickets
5 wooden scoring markers
and 1 rule book', 'English', 2005, 8, 30, 2, 5, 1, 9);

INSERT INTO public.products (id, created_at, updated_at, name, price, publisher, description, includes, language,
                             release_date, min_age, min_play_time, min_players, max_players, product_category_id,
                             product_sub_category_id)
VALUES (DEFAULT, '2021-11-14 03:06:29', '2021-11-14 03:06:30', 'Mandala', 19.99, 'Lookout Games', 'In the two-player game Mandala, you are trying to score more than your opponent by collecting valuable cards — but you won''t know which cards are valuable until well into the game! Over the course of the game, players play their colored cards into the two mandalas, building the central shared mountains and laying cards into their own fields. As soon as a mandala has all six colors, the players take turns choosing the colors in the mountain and adding those cards to their "river" and "cup". At the end of the game, the cards in your cup are worth points based on the position of their colors in that player''s river. The player whose cup is worth more points wins.', '1 paper game plan
108 cards
2 reference cards', 'English', 2019, 10, 30, 2, 2, 7, 9);


INSERT INTO public.products (id, created_at, updated_at, name, price, publisher, description, includes, language, release_date, min_age, min_play_time, min_players, max_players, product_category_id, product_sub_category_id)
VALUES (DEFAULT, '2021-11-14 18:14:29', '2021-11-14 18:14:34', 'Exploding Kittens', 19.99, 'Exploding Kittens', 'Exploding Kittens is a kitty-powered version of Russian Roulette. Players take turns drawing cards until someone draws an exploding kitten and loses the game. The deck is made up of cards that let you avoid exploding by peeking at cards before you draw, forcing your opponent to draw multiple cards, or shuffling the deck. The game gets more and more intense with each card you draw because fewer cards left in the deck means a greater chance of drawing the kitten and exploding in a fiery ball of feline hyperbole.', '1 paper game plan
56 cards', 'English', 2015, 7, 15, 2, 5, 4, 3);

INSERT INTO public.products (id, created_at, updated_at, name, price, publisher, description, includes, language, release_date, min_age, min_play_time, min_players, max_players, product_category_id, product_sub_category_id) VALUES (DEFAULT, '2021-11-14 18:14:35', '2021-11-14 18:14:36', 'Hanabi', 8.99, 'Cocktail Games', 'Hanabi—named for the Japanese word for "fireworks"—is a cooperative game in which players try to create the perfect fireworks show by placing the cards on the table in the right order. (In Japanese, hanabi is written as 花火; these are the ideograms flower and fire, respectively.) The card deck consists of five different colors of cards, numbered 1–5 in each color. For each color, the players try to place a row in the correct order from 1–5. Sounds easy, right? Well, not quite, as in this game you hold your cards so that they''re visible only to other players. To assist other players in playing a card, you must give them hints regarding the numbers or the colors of their cards. Players must act as a team to avoid errors and to finish the fireworks display before they run out of cards. An extra suit of cards, rainbow colored, is also provided for advanced or variant play.', '1 paper game plan
61 cards
11 tokens', 'No language dependence', 2010, 8, 25, 2, 5, 8, 9);
INSERT INTO public.products (id, created_at, updated_at, name, price, publisher, description, includes, language, release_date, min_age, min_play_time, min_players, max_players, product_category_id, product_sub_category_id) VALUES (DEFAULT, '2021-11-14 18:14:37', '2021-11-14 18:14:38', 'Speed Cups', 14.99, 'AMIGO', 'Haim Shafir''s most famous game design, Halli Galli, includes one of the best-known game props in existence: a bell. Players both young and old love to hit the bell after spotting a winning combination, so it''s no surprise to see the bell return in yet another Shafir design: Speed Cups, a.k.a. Quick Cups. In this game, each player receives a set of five plastic cups, each a different color; a deck of 24 cards is shuffled and placed face down in the center of the table next to the bell. One player flips over the top card, which depicts colored objects – trains, birds, cups, etc. – stacked vertically or horizontally, then everyone tries to recreate this colored sequence with her own set of cups. The first player to do slams the bell, revels in the soul-brightening "ding", then (if correct), claims the card. Someone then reveals the next card, and the players start shuffling cups once again. Once all the cards have been claimed, whoever holds the most cards wins!', '1 paper game plan
20 cups
24 cards
1 bell', 'No language dependence', 2014, 6, 15, 2, 4, 3, 3);

INSERT INTO public.products (id, created_at, updated_at, name, price, publisher, description, includes, language, release_date, min_age, min_play_time, min_players, max_players, product_category_id, product_sub_category_id) VALUES (DEFAULT, '2021-11-14 18:14:39', '2021-11-14 18:14:40', 'Activity Champion', 24.99, 'Piatnik', 'New edition of the well known party game Activity where you have to describe words verbal, pantomimic or by drawing. In this edition, players do not play in teams anymore, but try to get as many points for only themselves. The cards show 4 different words, as well as the way you need to explain them (verbally, pantomimic, by drawing). The rules are slightly changed so that it works without teams. Points are given to the player who guesses right and the player who acted, described or drew the words.', '1 paper game plan
440 cards
10 tokens
1 hour glass', 'English', 2015, 12, 60, 3, 10, 3, 3);

INSERT INTO public.products (id, created_at, updated_at, name, price, publisher, description, includes, language, release_date, min_age, min_play_time, min_players, max_players, product_category_id, product_sub_category_id) VALUES (DEFAULT, '2021-11-14 18:14:41', '2021-11-14 18:14:41', 'Keyforge: Age of Ascension', 9.99, 'Asmodee', 'KeyForge is played over a series of turns in which you, as the Archon leading your company, use the creatures, technology, artifacts, and skills of a chosen House to reap precious Æmber, hold off your enemy''s forces, and forge enough keys to unlock the Crucible''s Vaults. You begin your turn by declaring one of the three Houses within your deck, and for the remainder of the turn you may play and use cards only from that House. For example, if you take on the role of the Archon Radiant Argus the Supreme, you will find cards from Logos, Sanctum, and Untamed in your deck, but if you declare "Sanctum" at the start of your turn, you may use actions, artifacts, creatures, and upgrades only from Sanctum. Your allies from Logos and Untamed must wait. If you succeed in finding a harmony within your team and have six Æmber at the start of your turn, you''ll forge a key and move one step closer to victory. The first to forge three keys wins!', '36 cards
1 deck list', 'English', 2019, 14, 20, 2, 2, 7, 2);
INSERT INTO public.products (id, created_at, updated_at, name, price, publisher, description, includes, language, release_date, min_age, min_play_time, min_players, max_players, product_category_id, product_sub_category_id) VALUES (DEFAULT, '2021-11-14 18:14:42', '2021-11-14 18:14:43', 'Sherlock', 9.99, 'BoardM Factory', 'In Sherlock 13, first published as Holmes 13, the players take the role of a detective, trying to unmask the famous thief Arsene Lupin, who is among them in disguise. The game consists of 13 character cards, with 2 to 3 characteristics each. Each characteristic is shared by 3 to 5 characters. The cards are shuffled and one is drawn and put aside. This card represents the disguise chosen by Arsene Lupin. The other cards are distributed evenly among the players. The players now tally the total of characteristics they have on their cards (e.g. 2 detectives, 1 female, 0 genius etc) and note them for later use. Players now take turns, asking a question to gather new evidence: a.) To all players: "Who has (at least one) of (this characteristic)? OR b.) To one player: "How many of (this characteristic) do you have? Using these clues the players try to figure out which disguise Arsene has chosen (i.e. which card is missing). Instead of a question, a player may announce which character he suspects to be Arsene in disguise. That player then secretly checks the hidden card. If the suspicion was correct, this player wins the game, otherwise the player is eliminated and the other players continue.', '4 paper screens
13 cards
Block of investigation papers
1 paper game plan', 'No language dependence', 2018, 10, 15, 2, 4, 6, 8);

INSERT INTO public.products (id, created_at, updated_at, name, price, publisher, description, includes, language, release_date, min_age, min_play_time, min_players, max_players, product_category_id, product_sub_category_id) VALUES (DEFAULT, '2021-11-14 18:14:44', '2021-11-14 18:14:44', 'Black Stories', 7.99, 'MINDOK', '50 black stories, 31 crimes, 49 corpses, 11 murders, 12 suicides and one deadly meal. How could that have happened? Black Stories are fiddly, morbid and mysterious riddles for teenagers and adults. The players try to reconstruct the crime by asking, guessing and fiddling about. A spooky card game just right for any party.', '50 black stories
1 paper game plan', 'English', 2009, 12, 10, 2, 20, 4, 5);

INSERT INTO public.products (id, created_at, updated_at, name, price, publisher, description, includes, language, release_date, min_age, min_play_time, min_players, max_players, product_category_id, product_sub_category_id) VALUES (DEFAULT, '2021-11-14 18:14:45', '2021-11-14 18:14:46', 'Thebes: The Tomb Raiders', 19.99, 'Queen Games', 'Thebes: The Tomb Raiders is a card game version of the Thebes board game from designer Peter Prinz and Queen Games. The game dispenses with the map of Thebes, but retains many of the main aspects of the game. The main turn-order play of the game is based on the time-track; players must spend time to take actions, with varying amounts of time spent dependent on the nature and benefits of the action. The player who is furthest back "in time" is the active player. Players use actions to gain knowledge about five civilizations, and then use this knowledge in different actions to "dig" to pull cards from a civilization''s deck that contains treasures and dirt. The more knowledge a player has about a civilization, the more efficient the player is at searching for treasures.', '1 storage board including time scale
168 small cards
1 paper game plan', 'No language dependence', 2013, 8, 30, 2, 4, 6, 7);
INSERT INTO public.products (id, created_at, updated_at, name, price, publisher, description, includes, language, release_date, min_age, min_play_time, min_players, max_players, product_category_id, product_sub_category_id) VALUES (DEFAULT, '2021-11-14 18:15:57', '2021-11-14 18:16:00', 'Kombo Afrika', 10.99, 'Loris Games', 'A lion, a crocodile, a gorilla and a rhinoceros meet on the shore of Lake Victoria. The lion roars (as he always has been the king of the animals), the crocodile suggests him to repeat that closer to the water edge, gorilla starts to beat its chest like King Kong and the rhino says "Do recognize my horn as the royal crown or I will have to use it in a different way..." Then they make a deal: the new king will be named the one who gets the biggest support of other animals. Gather the animals (cards in your hand) into the herds (on the table), use their abilities and deploy them in the right combinations to achieve points. Flip them face down (and sometimes face up). Use your memory as much as your tactical and combinatorical reasoning.', '48 cards
8 tokens
4 hint cards
1 paper game plan', 'No language dependence', 2019, 10, 20, 2, 4, 4, 1);

INSERT INTO public.product_photos (id, created_at, updated_at, name, product_id)
VALUES (DEFAULT, '2021-11-13 22:32:24', '2021-11-13 22:32:22', '1main.jpg', 1);
INSERT INTO public.product_photos (id, created_at, updated_at, name, product_id)
VALUES (DEFAULT, '2021-11-13 22:32:50', '2021-11-13 22:32:51', '1back.jpg', 1);
INSERT INTO public.product_photos (id, created_at, updated_at, name, product_id)
VALUES (DEFAULT, '2021-11-13 22:32:54', '2021-11-13 22:32:55', '1play.jpg', 1);
INSERT INTO public.product_photos (id, created_at, updated_at, name, product_id)
VALUES (DEFAULT, '2021-11-14 03:10:10', '2021-11-14 03:10:11', '2main.jpg', 2);
INSERT INTO public.product_photos (id, created_at, updated_at, name, product_id)
VALUES (DEFAULT, '2021-11-14 03:10:10', '2021-11-14 03:10:11', '3main.jpg', 3);
INSERT INTO public.product_photos (id, created_at, updated_at, name, product_id)
VALUES (DEFAULT, '2021-11-13 22:32:50', '2021-11-13 22:32:51', '3back.jpg', 3);
INSERT INTO public.product_photos (id, created_at, updated_at, name, product_id)
VALUES (DEFAULT, '2021-11-13 22:32:54', '2021-11-13 22:32:55', '3play.jpg', 3);
INSERT INTO public.product_photos (id, created_at, updated_at, name, product_id)
VALUES (DEFAULT, '2021-11-14 03:10:10', '2021-11-14 03:10:11', '4main.jpg', 4);
INSERT INTO public.product_photos (id, created_at, updated_at, name, product_id)
VALUES (DEFAULT, '2021-11-13 22:32:50', '2021-11-13 22:32:51', '4back.jpg', 4);
INSERT INTO public.product_photos (id, created_at, updated_at, name, product_id)
VALUES (DEFAULT, '2021-11-13 22:32:54', '2021-11-13 22:32:55', '4play.jpg', 4);
INSERT INTO public.product_photos (id, created_at, updated_at, name, product_id)
VALUES (DEFAULT, '2021-11-14 03:10:10', '2021-11-14 03:10:11', '5main.jpg', 5);
INSERT INTO public.product_photos (id, created_at, updated_at, name, product_id)
VALUES (DEFAULT, '2021-11-13 22:32:50', '2021-11-13 22:32:51', '5back.jpg', 5);
INSERT INTO public.product_photos (id, created_at, updated_at, name, product_id)
VALUES (DEFAULT, '2021-11-13 22:32:54', '2021-11-13 22:32:55', '5play.jpg', 5);
INSERT INTO public.product_photos (id, created_at, updated_at, name, product_id)
VALUES (DEFAULT, '2021-11-14 03:10:10', '2021-11-14 03:10:11', '6main.jpg', 6);
INSERT INTO public.product_photos (id, created_at, updated_at, name, product_id)
VALUES (DEFAULT, '2021-11-13 22:32:50', '2021-11-13 22:32:51', '6back.jpg', 6);
INSERT INTO public.product_photos (id, created_at, updated_at, name, product_id)
VALUES (DEFAULT, '2021-11-13 22:32:54', '2021-11-13 22:32:55', '6play.jpg', 6);
INSERT INTO public.product_photos (id, created_at, updated_at, name, product_id)
VALUES (DEFAULT, '2021-11-14 03:10:10', '2021-11-14 03:10:11', '7main.jpg', 7);
INSERT INTO public.product_photos (id, created_at, updated_at, name, product_id)
VALUES (DEFAULT, '2021-11-13 22:32:50', '2021-11-13 22:32:51', '7back.jpg', 7);
INSERT INTO public.product_photos (id, created_at, updated_at, name, product_id)
VALUES (DEFAULT, '2021-11-13 22:32:54', '2021-11-13 22:32:55', '7play.jpg', 7);
INSERT INTO public.product_photos (id, created_at, updated_at, name, product_id)
VALUES (DEFAULT, '2021-11-14 03:10:10', '2021-11-14 03:10:11', '8main.jpg', 8);
INSERT INTO public.product_photos (id, created_at, updated_at, name, product_id)
VALUES (DEFAULT, '2021-11-13 22:32:50', '2021-11-13 22:32:51', '8back.jpg', 8);
INSERT INTO public.product_photos (id, created_at, updated_at, name, product_id)
VALUES (DEFAULT, '2021-11-13 22:32:54', '2021-11-13 22:32:55', '8play.jpg', 8);
INSERT INTO public.product_photos (id, created_at, updated_at, name, product_id)
VALUES (DEFAULT, '2021-11-14 03:10:10', '2021-11-14 03:10:11', '9main.jpg', 9);
INSERT INTO public.product_photos (id, created_at, updated_at, name, product_id)
VALUES (DEFAULT, '2021-11-13 22:32:50', '2021-11-13 22:32:51', '9back.jpg', 9);
INSERT INTO public.product_photos (id, created_at, updated_at, name, product_id)
VALUES (DEFAULT, '2021-11-13 22:32:54', '2021-11-13 22:32:55', '9play.jpg', 9);
INSERT INTO public.product_photos (id, created_at, updated_at, name, product_id)
VALUES (DEFAULT, '2021-11-14 03:10:10', '2021-11-14 03:10:11', '10main.jpg', 10);
INSERT INTO public.product_photos (id, created_at, updated_at, name, product_id)
VALUES (DEFAULT, '2021-11-13 22:32:50', '2021-11-13 22:32:51', '10back.jpg', 10);
INSERT INTO public.product_photos (id, created_at, updated_at, name, product_id)
VALUES (DEFAULT, '2021-11-13 22:32:54', '2021-11-13 22:32:55', '10play.jpg', 10);
INSERT INTO public.product_photos (id, created_at, updated_at, name, product_id)
VALUES (DEFAULT, '2021-11-14 03:10:10', '2021-11-14 03:10:11', '11main.jpg', 11);
INSERT INTO public.product_photos (id, created_at, updated_at, name, product_id)
VALUES (DEFAULT, '2021-11-13 22:32:50', '2021-11-13 22:32:51', '11back.jpg', 11);
INSERT INTO public.product_photos (id, created_at, updated_at, name, product_id)
VALUES (DEFAULT, '2021-11-13 22:32:54', '2021-11-13 22:32:55', '11play.jpg', 11);
INSERT INTO public.product_photos (id, created_at, updated_at, name, product_id)
VALUES (DEFAULT, '2021-11-14 03:10:09', '2021-11-14 03:10:10', '2play.jpg', 2);
INSERT INTO public.product_photos (id, created_at, updated_at, name, product_id)
VALUES (DEFAULT, '2021-11-14 03:10:10', '2021-11-14 03:10:11', '2back.jpg', 2);


insert into public.users (id, first_name, email, email_verified_at, password, remember_token, created_at, updated_at, surname, city, street, country, postal_code, phone_number) values (1, 'Administrator', 'admin@gmail.com', null, '$2y$10$YldX9jvdBZIWsv0n3ezNDOaPP6yQRPaN0n4Ls4NUg4kJPAih8oz76', null, '2021-11-26 17:57:13', '2021-11-27 19:00:32', 'ADMIN', 'AdminCity', 'Adminská 4', 'Slovakia', '123456798', '+42196312');

insert into public.role_user (id, created_at, updated_at, user_id, role_id) values (1, '2021-11-26 18:58:10', '2021-11-26 18:58:11', 1, 1);