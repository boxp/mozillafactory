CC = compass compile
SRCS = \
  ./theme.scss

all: debug

debug: $(SRCS)
	$(CC) $(SRCS) -e development

lint: $(SRCS)
	$(CC) $(SRCS) --dry-run

release:
	$(CC) $(SRCS) -e production --force
