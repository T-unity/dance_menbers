#-----------------------
# ・ECSへデプロイする用のNginxイメージ
# ・補足はLaravelイメージと同じ。
#-----------------------

# ビルドコマンド
# docker build -f ./nginx.Dockerfile . -t dancers/nginx

FROM nginx:1.20
WORKDIR /data
ENV TZ=UTC
COPY ./infra/docker/nginx/*.conf /etc/nginx/conf.d/
