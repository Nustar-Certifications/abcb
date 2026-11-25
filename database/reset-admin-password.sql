-- Run once in phpMyAdmin on live (select your site DB, often named ab-cb).
UPDATE `r_control`
SET `username` = 'admin@gmail.com',
    `password` = SHA1('Ab@#b53Cb')
WHERE `id` = 1;

-- If 0 rows affected, admin row is missing — run this instead:
-- INSERT INTO `r_control` (`id`, `username`, `password`, `cookiesToken`, `lastLogin`)
-- VALUES (1, 'admin@gmail.com', SHA1('Ab@#b53Cb'), '', NOW());