define({ "api": [
  {
    "type": "post",
    "url": "/auth/login.json",
    "title": "Login",
    "name": "Login",
    "group": "Auth",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "email",
            "description": "<p>Users unique email.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "password",
            "description": "<p>Users password.</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "token",
            "description": "<p>JWT token.</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "/var/www/html/src/Controller/AuthController.php",
    "groupTitle": "Auth"
  },
  {
    "type": "post",
    "url": "/positions/add.json",
    "title": "Add Position",
    "name": "Add_Position",
    "group": "Positions",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": "<p>Positions title.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "description",
            "description": "<p>Positions description.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "address",
            "description": "<p>Positions address.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "salary",
            "description": "<p>Positions salary.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "company",
            "description": "<p>Users company.</p>"
          }
        ]
      }
    },
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>JWT token</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "position",
            "description": "<p>Position Object JSON.</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "/var/www/html/src/Controller/PositionsController.php",
    "groupTitle": "Positions"
  },
  {
    "type": "put",
    "url": "/positions/edit/{id}.json",
    "title": "Edit Position",
    "name": "Edit_Position",
    "group": "Positions",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": "<p>Positions title.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "description",
            "description": "<p>Positions description.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "address",
            "description": "<p>Positions address.</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "salary",
            "description": "<p>Positions salary.</p>"
          },
          {
            "group": "Parameter",
            "type": "Boolean",
            "optional": false,
            "field": "status",
            "description": "<p>Positions status.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "company",
            "description": "<p>Users company.</p>"
          }
        ]
      }
    },
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>JWT token</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "position",
            "description": "<p>Position Object JSON.</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "/var/www/html/src/Controller/PositionsController.php",
    "groupTitle": "Positions"
  },
  {
    "type": "get",
    "url": "/positions/list.json",
    "title": "List Public Positions",
    "name": "List",
    "group": "Positions",
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Object[]",
            "optional": false,
            "field": "positions",
            "description": "<p>Array of Position Object JSON.</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "paginator",
            "description": "<p>Paginator Object JSON.</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "/var/www/html/src/Controller/PositionsController.php",
    "groupTitle": "Positions"
  },
  {
    "type": "get",
    "url": "/positions/search.json",
    "title": "Search Public Positions",
    "name": "Search",
    "group": "Positions",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "keyword",
            "description": "<p>Positions keyword.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "address",
            "description": "<p>Positions address.</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "salary",
            "description": "<p>Positions salary.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "company",
            "description": "<p>Positions company.</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Object[]",
            "optional": false,
            "field": "positions",
            "description": "<p>Array of Position Object JSON.</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "paginator",
            "description": "<p>Paginator Object JSON.</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "/var/www/html/src/Controller/PositionsController.php",
    "groupTitle": "Positions"
  },
  {
    "type": "post",
    "url": "/recruiters/add.json",
    "title": "Sign up",
    "name": "Sign_up",
    "group": "Recruiters",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>Users name.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "email",
            "description": "<p>Users unique email.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "password",
            "description": "<p>Users password.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "company",
            "description": "<p>Users company.</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "user",
            "description": "<p>User Object JSON.</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "/var/www/html/src/Controller/RecruitersController.php",
    "groupTitle": "Recruiters"
  }
] });
