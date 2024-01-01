INSERT INTO ratings (id, product_id, user_id, rating, title, description,date_created, helpful, not_helpful)
VALUES 
    (NULL,1, 1, 4, 'Great product', 'Really satisfied with the performance.',CURRENT_DATE, 15, 2),
    (NULL,2, 2, 5, 'Excellent wheels!', 'These wheels completely transformed my car.',CURRENT_DATE, 20, 0),
    (NULL,3, 3, 4, 'Effective car wash kit', 'Good value for money. Cleans well.',CURRENT_DATE, 12, 1),
    (NULL,4, 4, 3, 'Decent headlights', 'Could be brighter but overall not bad.',CURRENT_DATE, 8, 5),
    (NULL,4, 5, 5, 'Love the spoiler', 'Adds a sporty touch to my car.',CURRENT_DATE, 25, 3),
    (NULL,6, 6, 4, 'Improves performance', "Noticed a difference in my car's power.",CURRENT_DATE, 18, 1),
    (NULL,7, 7, 5, 'High-quality seat covers', 'Comfortable and well-made covers.',CURRENT_DATE, 30, 0),
    (NULL,8, 8, 3, 'Loud exhaust', 'Gives a good sound but too loud for me.',CURRENT_DATE, 10, 8),
    (NULL,9, 9, 4, 'Good brake pads', 'Sturdy and durable for heavy braking.',CURRENT_DATE, 14, 2),
    (NULL,10, 10, 5, 'Tuning chip works wonders', 'Significant boost in horsepower.',CURRENT_DATE, 22, 1);

INSERT INTO likes_dislikes (review_id, user_id, isLike)
VALUES 
    (1, 1, 1),  -- User 1 likes Review 1
    (1, 2, 0),  -- User 2 dislikes Review 1
    (2, 3, 1),  -- User 3 likes Review 2
    (2, 4, 1),  -- User 4 likes Review 2
    (3, 5, 1),  -- User 5 likes Review 3
    (3, 6, 0),  -- User 6 dislikes Review 3
    (4, 7, 0),  -- User 7 dislikes Review 4
    (4, 8, 1),  -- User 8 likes Review 4
    (5, 9, 1),  -- User 9 likes Review 5
    (5, 10, 1), -- User 10 likes Review 5
    (6, 1, 0),  -- User 1 dislikes Review 6
    (6, 2, 1),  -- User 2 likes Review 6
    (7, 3, 1),  -- User 3 likes Review 7
    (7, 4, 0),  -- User 4 dislikes Review 7
    (8, 5, 0),  -- User 5 dislikes Review 8
    (8, 6, 1),  -- User 6 likes Review 8
    (9, 7, 1),  -- User 7 likes Review 9
    (9, 8, 1),  -- User 8 likes Review 9
    (10, 9, 0), -- User 9 dislikes Review 10
    (10, 10, 1),-- User 10 likes Review 10