# PHPでCRUD処理を行う掲示板を作成しました

## 作成した掲示板について

- 日常的に気軽に使えるものであること、「あったらいいな」と思えるものをコンセプトにしようと考えました。
- 晩ごはんの情報共有による毎日の悩みからの解放とともに、何を食べたかの記録と確認が出来る、「みんなの晩ごはん」を共有する掲示板として作成しました。


- ひとまず、下記の動作を出来るようにし、完成としました。
  - 新規会員登録
  - ログイン
  - 投稿
  - 編集
  - 削除
  - マイページ
  - ページネーション
  - ログアウト

## 環境構築  

- AWS EC2上にLAMP構成としました。
  - Linux2
  - Apache/2.4.58
  - MariaDB(AWS RDS)
  - PHP8.1

## コンテンツの紹介

### 【トップ画面】

- 「みんなの晩ごはん」トップページになります。コンテンツのコンセプトの紹介文と、ログイン・新規会員登録が出来るようになっています。
![トップ画面](https://github.com/nozomi2303/phpboard/assets/129904330/2eed09ab-5f6f-4656-87c7-15a45381e880)


### 【新規会員登録】

- お名前、メールアドレス、パスワードを入力することで新規会員登録が出来ます。
![新規会員登録1](https://github.com/nozomi2303/phpboard/assets/129904330/11b84abb-1787-4ddf-a412-e19e9eeb3ede)  

- 全て空白や、入力がされていない場合はエラーが出るようになっています。
![新規会員登録2](https://github.com/nozomi2303/phpboard/assets/129904330/dcd4fb94-2b67-41d5-b8fb-d619b37b9af1)  

- 6文字以下や、確認のためのメールアドレスが異なる場合もエラーが表示されます。
![新規会員登録3](https://github.com/nozomi2303/phpboard/assets/129904330/6615fc4b-f188-48a3-b186-088def1f266b)  

- また、既に登録済みのメールアドレスを入力するとエラーになります。
![新規会員登録4]([register-error3.png](https://github.com/nozomi2303/phpboard/assets/129904330/2a12b8ff-1bdc-4cab-af2b-fd27414a27a7))  

- ユーザー登録確認画面です。登録する内容に問題が無ければ、そのまま登録するボタンを押します。パスワードは表示しません。
![確認](https://github.com/nozomi2303/phpboard/assets/129904330/2ce2782d-0fea-4546-b746-7151a6731c07)

- もし入力内容に間違いがある場合は、修正ボタンを押して戻ることができます。入力した内容が残っている仕様です（index.php?action=rewrite）。
![確認2](https://github.com/nozomi2303/phpboard/assets/129904330/f67d9f19-0bb9-4031-85af-49a532086268)

- 無事に会員登録が完了するとサンクスページに飛びます。
![サンクスページ](https://github.com/nozomi2303/phpboard/assets/129904330/05a1f482-08c8-4e18-8b3d-31ff78449988)


### 【ログイン】

- 会員登録が済んだらトップページからログインが出来ます。
- 未入力の場合はエラーが出ます。
![ログイン1](https://github.com/nozomi2303/phpboard/assets/129904330/c6d2b9a9-7522-4616-9e59-499d496aa497)
- メールアドレスやパスワードが異なる場合もエラーが出ます。
![ログイン2](https://github.com/nozomi2303/phpboard/assets/129904330/5ff4e7ed-42ac-4965-b16f-6557744247cb)

### 【投稿画面】  

- メインページである投稿画面です。
- マイページへのリンクやログアウトボタン、投稿フォームと、投稿一覧が確認出来ます。
![投稿画面1](https://github.com/nozomi2303/phpboard/assets/129904330/783d519b-8d56-467e-8a44-c1cc50586e78)

- 投稿します。
![投稿画面2](https://github.com/nozomi2303/phpboard/assets/129904330/07c3e5da-aceb-41f8-a294-e252fc145d90)

- 投稿できました。
![投稿画面2](https://github.com/nozomi2303/phpboard/assets/129904330/e3a4239a-740d-45e6-97da-68f8628bfc84)



### 【編集】  

- ログインしている本人のみが編集可能です。  

- 編集ボタンから編集をします。
![編集1](https://github.com/nozomi2303/phpboard/assets/129904330/715647ec-8280-4c20-9ca0-6602cc585a80)

- 編集画面で変更します。  
（シチューからカレーへ変更です。）
![編集2](https://github.com/nozomi2303/phpboard/assets/129904330/be105b61-0e08-448c-aeba-2da5f0d8e531)

- 編集を完了して投稿画面へ戻ります。
![編集3](https://github.com/nozomi2303/phpboard/assets/129904330/166d4518-f81a-47e0-a0e5-b634545d5648)

- 変更が完了していることが確認出来ます。  
（シチューからカレー変更出来ました。）
![編集4](https://github.com/nozomi2303/phpboard/assets/129904330/bcb9f6f6-2304-46d7-b984-aebf16d9cf08)

### 【削除】  

- ログインしている本人のみが削除可能です。
- 間違えて投稿してしまった場合など削除が可能です。  
（ごはん　コロッケ…の方を削除します。）
![削除](https://github.com/nozomi2303/phpboard/assets/129904330/71192a07-a06c-41cc-be74-883a8dc217fd)

- 投稿一覧から削除が完了しました。
![削除2](https://github.com/nozomi2303/phpboard/assets/129904330/5e89aa91-2842-430a-a783-c5208a92c4fd)

### 【マイページ】  
- コンセプトとなる毎日の晩ごはんの記録にもなるようにマイページを作成しました。
- 投稿画面へ戻るボタン、ログアウトボタンを設置。
- ログインしている本人が投稿したもののみが表示出来るようにしました。
![マイページ1](https://github.com/nozomi2303/phpboard/assets/129904330/f16b7341-6135-4f09-a48b-283d3142737c)
- マイページからも投稿ページと同じく、編集が可能です。  
（コロッケを編集、とんかつを追記します。）
![マイページ2](https://github.com/nozomi2303/phpboard/assets/129904330/0e982a35-c2e1-4520-bbb6-8f14b5748358)
![マイページ3](https://github.com/nozomi2303/phpboard/assets/129904330/7940c791-0929-4a22-9e49-0067650b43c9)  

- とんかつが追記出来ました。  
![マイページ4](https://github.com/nozomi2303/phpboard/assets/129904330/82cd79c1-fd71-4f50-b71a-f33cb00872a6)

- 同じく、削除も可能です。  
(コロッケ　とんかつが消えました。)
![マイページ5](https://github.com/nozomi2303/phpboard/assets/129904330/142f2ce1-7bb4-4576-88da-2899df2ac100)



### 【ページネーション】  
- 投稿数5件ごとにページを分けました。  
![ページネーション](https://github.com/nozomi2303/phpboard/assets/129904330/1f3536d3-6c26-4735-9036-66d58f89d816)

- 2ページ目
![ページネーション](https://github.com/nozomi2303/phpboard/assets/129904330/f6ec26f0-4a42-4771-8bf8-eb95de64a4f4)

- 3ページ目
![ページネーション](https://github.com/nozomi2303/phpboard/assets/129904330/b113f10e-0a95-4d1a-8025-5f1401338b6f)



### 【ログアウト】

- ログアウトボタンでセッションとcookieを削除し、ログインページへ戻ります。
- ログアウト後にpost.phpページへ直接URLを変更しても```header('Location: index.php');```でindex.phpへ飛ばされます。


## 今後に残る課題について


- 編集ボタンを押した際の空白の削除
    - 編集ボタンを押した後の入力した文字の末尾に半角の空白スペースが入ってしまいます。trim関数も使いましたが修正方法が分からず、また、データベースへ空白が入っていないので問題無いと考え、ひとまずはこのままにしています。  
  
![空白](https://github.com/nozomi2303/phpboard/assets/129904330/a7ac418c-2a32-4b14-8966-e3733305f983)


- 会員の退会処理  
  - 登録したのであれば退会処理も必要と考えています。  

- 画像のアップロード
    - 晩ごはんの掲示板のため、画像のアップロード機能もあった方が良いかと考えています。  
  
- いいねボタン  
  - 気軽なコミュニケーションツールとして、返信等は不要と考えていますが、いいねボタンがあった方が会員同士のモチベーションアップに繋がるのではないかと思います。  

- 投稿内容にリンクを貼る  
  - 利用規約等確認した方がいいかもしれませんが、クックパッド等料理サイトへのリンクを貼ることが出来ればお互いの料理の参考がさらにしやすくなると思います。  

- マイページ内でのページネーション処理
    - マイページ内にも実装しようと試みたのですが、他の投稿者のポストも取得してしまった為、実装に時間を要すると考えたためひとまずはこのままにしています。


## PHPによるWEBアプリケーションを作成した所感  

- PHPを利用するにあたり、まず様々な構築方法がある事を知り、さらにそこから何を選択するのが最適なのかを調べることに最初の1週間程度悩みました。今回は「AWS上で公開すること」という指定があったため、AWS EC2上にLAMP構成としました。  
- これまでHTMLやCSSを使用したことはあったので、PHPにも似たイメージを持ちましたが大きく異なっており大変難しく感じました。また様々な構文があるため当初は一から学習を進めていこうと考えていましたが、「何を作りたいか」の部分から触っていくことにしました。  
- PHP8.1のバージョンにより、参考書やネットの記事通りに記述してもエラーになる部分が多々あり、そこを解消することに時間が必要でした。
- PHPだけではなくSQL構文の学習も必要となり、学習を始めた当初は「どこまでがPHPでどこからがSQL文なのか？」が分からず理解するまでの時間を要しました。
- 作成するにあたり、ネットの記事をベースに作成をはじめ、エラーが解消出来ずそこから参考書を読み修正、その後は参考書ベースにして作成しました。バージョンにより記述方法が異なる、という点をしっかり理解していれば、選ぶべき参考書もPHP7のバージョンではなくPHP8を対応しているものを選ぶことができたことと、PHPのバージョンを7に下げて作成する、という対応も出来ていたのではないか、と反省しています。  
- 今後は、「今後に残る課題」として上記に記載している箇所の追加や修正を行いながら、さらに理解を進めていきたいと思います。


#### 主に参考にしたもの  


***参考書***  
[よくわかるPHPの教科書　PHP7対応版](https://amzn.asia/d/cCXf6k4)

***記事***  
- その他沢山ありますが、よく参考にしていた記事を一部抜粋

[PHPとMySQLを使った掲示板の作り方を初心者向けに7ステップ解説](https://biz.addisteria.com/bbs_creation0/)  

[【初心者向け】PHPで簡単なCRUD機能を実装するための手順](https://qiita.com/yan-ai/items/9adfc2d64ea425072378)

[AWS EC2 での LAMP 環境構築【Amazon Linux 2】](https://www.fujimiya-san.com/archives/610)

[プロメモ（MySQLの記事一覧）](https://26gram.com/category/mysql)


