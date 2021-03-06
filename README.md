# about

ダンス関係のメンバー募集掲示板

## 設計、要件定義

https://github.com/T-unity/dance_menbers/wiki/tables

## ECSへのデプロイ

作成が必要なリソース（リージョン、AZに関しては割愛）

■ ネットワーク関係

 - VPC
 - サブネット
 - ルートテーブル
 - セキュリティグループ
 - インターネットゲートウェイ
 - NATゲートウェイ
 - EIP / エラスティックIP

■ 負荷分散

 - ELB（ALB）

■ コンテナ関係

 - RDS
 - ECR
 - ECS（EC2ベースのコンテナインスタンス）
 - オートスケーリング

■ 監視

 - CloudWatch Logs

以下、各種リソースを作成する際のメモ等

<details>

## 通信の流れ

大まかに以下。

・IGW（VPC）→ALB→Nginxコンテナ→Laravelコンテナ→RDS（MySQL）

1. インターネットゲートウェイがHTTPリクエストを受信する
1. IGW→ロードバランサーに通信を転送する
1. ロードバランサー→Nginxコンテナに通信を転送する。Nginxコンテナはパブリックサブネットに設置するため、NATゲートウェイは経由しない。
1. Nginxコンテナ→Laravelコンテナに通信を転送。Laravelコンテナも同一のパブリックサブネット内に設置する。ALBから、AZ-0に設置したNginx→Laravelと通信が転送される。
1. LaravelとRDSが通信し、必要に応じて読み書きを行う。RDSはプライベートサブネットに設置するため外部インターネットからは接続できない。

### VPC

AWS内に自分専用のネットワーク領域を作成する。ネットマスク、Cidrブロックに関してはもう少し調査必要。

https://e-words.jp/w/CIDR.html

### サブネット

VPCを個別の小さなネットワークに分割して、それぞれに必要なコンポーネントを配置することでセキュリティレベルを強化する。（サブネットはAZをまたぐ事はできない。）

今回はパブリックサブネット（IGWへのルーティングあり）、プライベートサブネット（IGWへのルーティングなし）を各2づつ作成する。

（同一構成のサブネットをAZ1a,1cに複製して冗長化）

### ルートテーブル

サブネットにアタッチして使用。 サブネットから外に出る通信の通信先（通信をどこに発信するのか）を決める。

local（ローカルルート）→AWSにおいては、`VPCの内部、全てのネットワーク`を指す。デフォルトで設定されていて削除不可。

### インターネットゲートウェイ

VPCにアタッチする事で、VPCがインターネットと接続できるようになる。

VPC内に存在するAWSリソースがインターネットと接続するために必要。
実際は、各リソースにアタッチされているENIとIGが疎通を行う。

サブネットのルートテーブルの指定で、IGWにむけたルーティングを設定する。

### NATゲートウェイ

プライベートサブネットがインターネットに接続したい場合にNATゲートウェイを使用する。

#### IGWとは何が違うのか？

アウトバウンド（通信の発信）のみ可能でインバウンド（通信の受信）はできない。

つまり、プライベートサブネットに配置するインスタンスをインターネットと接続したい場合は、IGW→NATGW→目的のインスタンス、という経路を経る必要がある。

パブリックサブネットの場合は、IGW→目的のインスタンス、でOK。

### ENI（エラスティックネットワークインターフェース）

AWS内の各種インスタンスにアタッチして使用する仮想ネットワークインターフェース。

EC2には自動で付与される。つまり、EC2のIPアドレスの実体はENIに付与されたIPアドレスだと言うことができる。

#### ネットワークインターフェースとは？

以下の記事が分かりやすい。

https://onl.sc/rbbLhjh

https://qiita.com/takahiro_tnk/items/c500a4d915562cca28e7

エラスティックIPの付与等も、厳密にはインスタンスではなくENIに対して付与している。

### セキュリティグループ

AWSの仮想ファイアウォールサービス。

インバウンド、アウトバウンドに関するルールを設定可能。

サブネット内に複数のインスタンスが存在する場合、各インスタンスに対して個別にセキュリティグループの設定が可能。（当然複数のインスタンスに対して同一のSGをアタッチする事も可能。）

※厳密にはENI単位でセキュリティグループが設定されているが、構成図とかではそこまで厳密に書く必要はなく、インスタンスに直接SGがアタッチされているようにすればOK。

### EIP / エラスティックIP

※RDS用とかEC2用とか色々作ってる

AWSの仮想ファイアウォール。通信を許可するホワイトリスト形式での指定のみ可能。
各種AWSリソースに対して個別に設定可能（厳密にはインスタンスではなくENIにアタッチする。）
アウトバンドが許可されている通信先に対してはインバウンドも許可される。

### ELB（ALB）

 ELBはアクセスポイントを一つにまとめる＆負荷分散、ヘルスチェック、HTTPS通信の復号等を行ってくれる。


### RDS
### ECR
### ECS（EC2ベースのコンテナインスタンス）
### オートスケーリング
### CloudWatch Logs

</details>
