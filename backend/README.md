# Fleet Management API

The Fleet Management API provides endpoints for managing fleet sets, trucks, trailers, and service orders.

## Table of Contents
- [Setup Locally](#setup-locally)
- [API Endpoints](#api-endpoints)
  - [Fleet Sets](#fleet-sets)
  - [Trucks](#trucks)
  - [Trailers](#trailers)
  - [Service Orders](#service-orders)

## Setup Locally

To set up this API locally, follow these steps:

1. **Install dependencies:**
   ```bash
    cd docker
    ./init
    cp .env.example .env
   ```
2. **Set up your environment file:**
   ```bash
   cd ../backend
   cp .env.example .env
   cd ../docker
   ./devo artisan key:generate
   ```
3. **Run the migrations to set up the database:**
   ```bash
   ./devo artisan migrate --seed
   ```
   The API will be available at `http://localhost:81`.

## API Endpoints

### Fleet Sets

- **GET /fleet-sets**
  - **Description**: Retrieves a list of all fleet sets.
  - **Response**: 
    - 200 OK - Returns a collection of fleet sets.
  
- **GET /fleet-sets/{fleetSet}**
  - **Description**: Retrieves a specific fleet set by its ID.
  - **Parameters**:
    - `fleetSet`: The ID of the fleet set to retrieve.
  - **Response**: 
    - 200 OK - Returns the requested fleet set.

### Trucks

- **GET /trucks**
  - **Description**: Retrieves a list of all trucks.
  - **Response**:
    - 200 OK - Returns a collection of trucks.
  
- **GET /trucks/{truck}**
  - **Description**: Retrieves a specific truck by its ID.
  - **Parameters**:
    - `truck`: The ID of the truck to retrieve.
  - **Response**:
    - 200 OK - Returns the requested truck.

### Trailers

- **GET /trailers**
  - **Description**: Retrieves a list of all trailers.
  - **Response**:
    - 200 OK - Returns a collection of trailers.
  
- **GET /trailers/{trailer}**
  - **Description**: Retrieves a specific trailer by its ID.
  - **Parameters**:
    - `trailer`: The ID of the trailer to retrieve.
  - **Response**:
    - 200 OK - Returns the requested trailer.

### Service Orders

- **GET /service-orders**
  - **Description**: Retrieves a list of all service orders.
  - **Response**:
    - 200 OK - Returns a collection of service orders.
  
- **GET /service-orders/{serviceOrder}**
  - **Description**: Retrieves a specific service order by its ID.
  - **Parameters**:
    - `serviceOrder`: The ID of the service order to retrieve.
  - **Response**:
    - 200 OK - Returns the requested service order.
