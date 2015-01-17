# Start from Dockie https://github.com/robloach/dockie
FROM dockie/dockie

# When run, set up the PHP web server.
CMD ["php", "-S", "0.0.0.0:80"]

EXPOSE 80 22
VOLUME ["/app"]
WORKDIR /app
