National Strong Motion Project
==============================

Web application for Earthquake Science Center's [National Strong Motion Project](https://earthquake.usgs.gov/monitoring/nsmp/).

## Installation

First install [Node.js](https://nodejs.org/) and [Grunt](https://gruntjs.com).

**Note**: You will also need PHP with CGI installed.

1. Clone the repository

```
git clone https://github.com/shaefner-usgs/earthquake-nsmp.git
```

2. Install dependencies

```
cd earthquake-nsmp
npm install

# If you need to add a CA certificate file:
npm config set cafile "<path to your certificate file>"

# Check the 'cafile'
npm config get cafile
```

3. Configure the app

```
cd earthquake-nsmp/src/lib

# Run the configuration script
./pre-install
```

4. Run grunt

```
cd earthquake-nsmp
grunt
```
