FROM node:20

WORKDIR /var/www

# Copy package files from frontend
COPY ./frontend/package*.json ./

# Install frontend dependencies
RUN npm install

# Copy rest of the frontend code
COPY ./frontend .

# Expose Vite's default dev port
EXPOSE 5173

# Run dev server accessible from outside container
CMD ["npm", "run", "dev", "--", "--host"]