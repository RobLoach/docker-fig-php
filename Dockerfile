# Start from Forge https://github.com/robloach/forge
FROM robloach/forge

# When run, set up the PHP web server.
CMD ["php", "-S", "0.0.0.0:80"]

EXPOSE 80 22
VOLUME ["/app"]
WORKDIR /app
