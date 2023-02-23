---
layout: post
title: "Rate limit Api endpoint wth redis 'GCRA' algorithm working example"
date:   2023-02-23 15:58:41 +0400
categories: blog
---
Recently, I was working on a project that required rate limiting an endpoint. I found a lot of articles on the internet
and used two ways of them.

One of them I explained
in [this article](https://medium.com/@BeriaGiorgi/rate-limit-drf-endpoint-with-redis-working-example-eb047426da98)

Again, for more theory, you can use
this [article on the internet that I found](https://engineering.ramp.com/rate-limiting-with-redis)

I will show you my working example.
Install Redis. I will use Rocky Linux 9 for this example.

### 1 Install Redis service

{% highlight Shell %}
sudo yum install redis
{% endhighlight %}

### 2 Enable, Start and check the status of Redis

{% highlight Shell %}
sudo systemctl enable redis

sudo systemctl start redis

sudo systemctl status redis
{% endhighlight %}
It should look like this:
![redis_status.png](/img/blog/redis_status.png)

next, we need to install the python client for Redis

### 1 Install Redis python client

{% highlight Python %}
pip install redis
{% endhighlight %}

This time we are not linked to a framework, you can use this guide for any framework you use.

### 2 put the following code in your project

{% highlight Python %}

    def request_is_limited(redis_conn: Redis, key: str, limit: int, period: timedelta) -> bool:
        period_in_seconds = int(period.total_seconds())
        now = redis_conn.time()[0]
        separation = period_in_seconds / limit
        redis_conn.setnx(key, 0)
        try:
            with redis_conn.lock(f"lock:{key}", blocking_timeout=5):
                theoretical_arrival_time = max(float(redis_conn.get(key)) or now, now)
                if theoretical_arrival_time - now <= period_in_seconds - separation:
                    new_arrival_time = max(theoretical_arrival_time, now) + separation
                    redis_conn.set(key, new_arrival_time)
                    return False
                return True
        except LockError:
            return True

{% endhighlight %}
This is the main function that does the rate limiting. It uses
the [GCRA algorithm](https://en.wikipedia.org/wiki/Generic_cell_rate_algorithm)
which is a special case of the [leaky bucket algorithm](https://en.wikipedia.org/wiki/Leaky_bucket). Instead of
simulating a leak this one computes a "theoretical arrival time" (TAT) that the next request would have to meet. After
each successful request, the TAT is increased by a small amount.

if users make requests faster than the TAT, they will be rate limited.

### 3 use it in your project

in my case, I had too many auth attempts from the same user, so I used this function to rate limit the login endpoint.

{% highlight Python %}

    class TooManyRequestsExeption(Exception):
        name = "TooManyRequestsExeption"
    
    redis_connection = Redis(host="localhost", port=6379, db=0)
    
    username = attrs["username"]
    password = attrs["password"]

    if request_is_limited(redis_connection, username, 30, timedelta(seconds=60)):
        raise TooManyRequestsExeption("Too many requests")

{% endhighlight %}

### 4 Test Functionality

{% highlight Python %}

    request_count = 100
    url = "http://localhost:8001/auth/"
    payload = json.dumps({"username": "123456789", "password": "123456"})
    headers = {"Content-Type": "application/json"}
    for _ in range(request_count):
        response = requests.request("POST", url, headers=headers, data=payload)
        if response.status_code == 200:
            print(datetime.datetime.now(), "request is not limited")
        else:
            print(datetime.datetime.now(), "request is limited")

{% endhighlight %}

when we reach the limit, we respond with a 429 status code:
![rate_leaky_gcra.png](/img/blog/rate_leaky_gcra.png)

As you can see, when we reach the limit, requests are denied. But every some time when current time catches up to the
TAT more requests can be made.

### 5 Conclusion
It turns out this method is very memory efficient since it only needs to store a few variables to do this.


I hope this article was helpful to you.





