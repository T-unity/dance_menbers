#-----------------------
# ・ECSへデプロイする用のNginxイメージ
# ・補足はLaravelイメージと同じ。
#-----------------------

FROM nginx:1.20
WORKDIR /data
ENV TZ=UTC
COPY ./infra/docker/nginx/*.conf /etc/nginx/conf.d/
