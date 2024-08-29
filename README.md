## SETUP
Tested on php 8.3.6, WSL, Ubuntu 20.x, require Composer + common php libs..

1. Clone the repository by your method
2. ```cd TestApp```
3. ```composer install```
4. Copy ```.env.example``` and rename it to ```'.env'```
5. Edit ```.env``` if you need (by default you don't need)

## USE

index.php contain all possible examples:
1. ```cd TestApp```
2. Run local server ```php -S localhost:8000```
3. Go to browser ```http://localhost:8000/```
4. Check ```index.php``` how to use it

## RUN TESTS
1. ```cd TestApp```
2. ```vendor/bin/tester .```

## LIMITATIONS
    
- Doesn't have paginator
- Only 2 endpoints
- Only ```http GET``` method is implemented
- No cache
- No async requests
- Not enough tests cover
- Query params/input may be problematic for example boolean value in parameters true need be 'true', all should be casted to string.
- Mess with Demo and PRO versions ```OHLC - Exclusive daily and hourly candle interval parameter for all paid plan subscribers (interval = daily, interval=hourly)```
- Higher precision of float prices may not work as expected, tested only for 2 precision
...
