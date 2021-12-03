## インストール後の実施事項

画像のダミーデータは
/public/images/ 内に
sample1.jpg 〜 sample6.jpg として保存してあります。

php artisan storage:link
で storage フォルダにリンク後
/storage/app/public/products 内に保存すると表示されます。
※ products フォルダがない場合は作成してください。

ショップの画像も表示する場合は
/storage/app/public/shppsフォルダを作成し保存してください

