Feature: Search Orders
  In order to invest with Finizens
  Customers should be able to
  list orders in our system

  Scenario: Search orders by portfolio
    Given I send a GET request to "/orders?filters=portfolio = 10001&limit=1&offset=1"
    Then the response status code should be 200
    And the response body should be:
    """
      {
        "data":[
          {
            "id": 10005,
            "portfolio": 10001,
            "allocation": 10003,
            "shares": 76,
            "type": "sell",
            "status": "pending"
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


  Scenario: Search orders by criteria
    Given I send a GET request to "/orders?filters=portfolio = 10002 and type = buy and status = completed&order=status desc&limit=1&offset=1"
    Then the response status code should be 200
    And the response body should be:
    """
      {
        "data":[
          {
            "id": 10009,
            "portfolio": 10002,
            "allocation": 10010,
            "shares": 42,
            "type": "buy",
            "status": "completed"
          }
        ],
        "meta": {
          "offset": 1,
          "limit": 1,
          "items": 1,
          "total": 2
        }
      }
    """

