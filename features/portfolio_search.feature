Feature: Search Portfolios
  In order to invest with Finizens
  Customers should be able to
  list a portfolios in our system

  Scenario: Search portfolios by criteria
    Given I send a GET request to "/portfolio?order=createdAt desc&limit=1&offset=1"
    Then the response status code should be 200
    And the response body should be:
    """
      {
        "data":[
          {
            "id": 10001,
            "allocations": [
              {
                "id": 10003,
                "shares": 21
              },
              {
                "id": 10004,
                "shares": 251
              }
            ]
          }
        ],
        "meta": {
          "offset": 1,
          "limit": 1,
          "items": 1,
          "total": 3
        }
      }
    """