FROM node

# Set working directory
WORKDIR /home/api

# Copy & install NPM modules
COPY ./package.json /home/api/package.json
RUN npm install --silent

# Copy app files
COPY . /home/api

# Start the API
CMD ["npm", "start"]

# Open the port
EXPOSE 4739
