Feature: Search Portfolios
  In order to invest with Finizens
  Customers should be able to
  create new portfolios in our system

  Scenario: New valid portfolios
    Given I send a PUT request to "/portfolio" with body:
    """
    {
      "id": 1,
      "allocations": [
        {
          "id": 1,
          "shares": 3
        },
        {
          "id": 2,
          "shares": 4
        }
      ]
    }
    """
    Then the response status code should be 200
    And the response should be empty
    When I send a PUT request to "/portfolio" with body:
    """
    {
      "id": 2,
      "allocations": [
        {
          "id": 3,
          "shares": 32
        },
        {
          "id": 4,
          "shares": 21
        }
      ]
    }
    """
    When I send a GET request to "/portfolio?order=id desc&limit=1"
    Then the response status code should be 200
    And the response body should be:
    """
      {
        "data":[
          {
            "id": 2,
            "allocations": [
              {
                "id": 3,
                "shares": 32
              },
              {
                "id": 4,
                "shares": 21
              }
            ]
          }
        ],
        "meta": {
          "offset": 0,
          "limit": 1,
          "items": 1,
          "total": 2
        }
      }
    """