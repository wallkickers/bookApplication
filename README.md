<img width="1440" alt="top" src="https://user-images.githubusercontent.com/37321193/72673447-fad15f00-3aad-11ea-9fac-6de3484edc75.png">

<h1 align="center">BookMark</h1>

<p align="center">
  <img src="https://user-images.githubusercontent.com/37321193/72674232-a7640e80-3ab7-11ea-81e8-d59a7d3c5a72.png" width="150px;" />
  <br>
  <br>
  <img src="https://user-images.githubusercontent.com/37321193/72673592-27867600-3ab0-11ea-8fa1-bb909a6863c9.png" height="50px;" />
  <img src="https://user-images.githubusercontent.com/37321193/72673637-d1fe9900-3ab0-11ea-88fc-b59e9ea60c28.png" height="50px;" />
</p>

## URL

### **https://bookmark-tm.herokuapp.com**  
　
## Usage

`$ git clone https://github.com/wallkickers/bookApplication.git`  
　
## 構築方法

```
※環境構築にはDockerが必要です。

// App用ディレクトリ作成
git clone https://github.com/wallkickers/bookApplication.git
cd bookApplication/env

// dockerコンテナ「web」「env」の作成
docker-compose up -d
docker-compose exec web bash
composer install

// envファイル生成
cp .env.example .env
php artisan key:generate

// envファイル内にDB情報を記述
DB_CONNECTION=mysql
DB_HOST=mysql
DB_DATABASE=bookMark
DB_USERNAME=root
DB_PASSWORD=password

// DBの構築&初期データ作成
php artisan migrate
php artisan db:seed

// ブラウザで接続
http://localhost:10080
```

