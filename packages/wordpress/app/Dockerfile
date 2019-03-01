FROM node

# Set working directory
WORKDIR /home/app

# Copy & install NPM modules
COPY ./package.json /home/app/package.json
RUN npm install --silent

# Copy app files
COPY . /home/app

# Start the API
CMD ["npm", "start"]

# Open the port
EXPOSE 4001
