FROM robloach/forge

CMD ["php", "-S", "0.0.0.0:80"]

EXPOSE 80
VOLUME ["/app"]
WORKDIR /app
