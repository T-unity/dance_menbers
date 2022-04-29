# cloudformationを用いたインフラのコード化

## 概要

AWSでのアプリケーション運用に必要なインフラ構築をコード化。
yml,jsonが使える。

実際にデプロイする際は、AWS-CLIを利用してコマンドラインからスタックの作成ができるが、初めのうちはAWSのGUI上からテンプレートファイルを適用するのが分かりやすい。

### スタック

一つのテンプレートから作成されたAWSリソースのまとまり（VPC,EC2など...）
どのテンプレートからどのリソース、インスタンスが作成されたのか管理が容易になる

## スニペットツール

`CloudFormation Snippets`

ymlファイルを新規作成して、`cfn`を入力すれば以下のようなAWSリソース作成の骨格が作られる。

<details>
```
AWSTemplateFormatVersion: 2010-09-09
Description: |

Parameters:

Metadata:

Mappings:

Conditions:

Resources:

Transform:

Outputs:

```
</details>
