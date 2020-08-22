FROM node:alpine

# Set working directory
WORKDIR /plugin

# Copy & install NPM modules
COPY ./package.json /plugin/package.json
RUN npm install --silent

# Copy app files
COPY . /plugin

# Start the API
CMD ["npm", "start"]

# Open the port
EXPOSE 4000