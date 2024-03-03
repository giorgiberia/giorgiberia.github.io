---
layout: post
title: "Using decorators to validate input data on django rest viewsets working example"
date:   2024-03-03 10:58:41 +0400
categories: blog
---

Recently,
I stumbled upon a [Real Python Podcast episode 192](https://realpython.com/podcasts/rpp/192/)
where they were talking about decorators. 
I always liked more control over stuff and used decorators rarely, 
but this episode made me look at them differently.

I wanted a clear picture of fields somewhere near with methods,
so that when somebody asked me what to send to the endpoint,
I could just point them to the method. 
{% highlight Python %}

    @parse_request_params(
        receiver=(int, "required"),
        type=(str, "required"),
        msg=(int, "required"),
    )
    def create(self, request: Request, parsed_params: dict) -> JsonResponse:
    """
    This method is for creating a new notification in Back Office for operators.
    :param request:
    :param parsed_params:
    :return:
    """
{% endhighlight %}

So why I decided to describe parameters with tuple of a type and required string?
Because I wanted to validate types for not only the required fields 
but also for the optional ones.

Let's see how this decorator is implemented.

{% highlight Python %}

    def parse_request_params(**expected_params):
    """
    A decorator that parses and validates parameters from the request body.
    :param expected_params: Dictionary of expected parameters and their types
    with requirement identifying string.
    :return: Decorator function.
    """
        def decorator(view_func):
            @wraps(view_func)
            def wrapped_view(self, request, *args, **kwargs):
                # Initialize a dictionary to store parsed parameters
                parsed_params = {}
    
                # Extract and validate each expected parameter from the request
                for param_name, param_info in expected_params.items():
                    param_type, param_required = param_info
    
                    param_value = request.data.get(param_name)
    
                    if param_value is not None:
                        # Check if the parameter has the expected type
                        if not isinstance(param_value, param_type):
                            expected_type_name = (
                                param_type.__name__
                                if hasattr(param_type, "__name__")
                                else str(param_type)
                            )
                            return respond_with_json(
                                -1,
                                f"Invalid type for parameter: {param_name},
                                  expected {expected_type_name} ",
                                extra={
                                    "error": INVALID_PARAMETER_TYPE,
                                },
                            )
                        parsed_params[param_name] = param_value
                    elif param_required == 'required':
                        # Parameter is required but missing in the request
                        return respond_with_json(
                            -1,
                            f"Missing required parameter: {param_name}",
                            extra={
                                "error": MISSING_OR_INVALID_PARAMETER,
                            },
                        )
    
                # Include any not required but present parameters in parsed_params
                for param_name, param_value in request.data.items():
                    if param_name not in expected_params:
                        parsed_params[param_name] = param_value
    
                # Pass the parsed parameters to the original view function
                return view_func(self, request, parsed_params, *args, **kwargs)
    
            return wrapped_view
    
        return decorator

{% endhighlight %}

At first, we define a decorator function that takes expected_params as a parameter.

We loop over expected_params and check if the parameter is present in the request,
if it is, we check if it has the expected type, if not, we return a response with an error message.

If the parameter is not present in the request, but it is required, 
we return a response with an error message.

After that,
we loop over all the parameters in the request
and add them to the parsed_params even if they are not present in expected_params.
This way, we do not lose any data that was sent to the endpoint.

Finally, we pass the parsed_params to the original view function.

So if I send for example "type" as an integer, this is what the response looks like

{% highlight Shell %}

    {
        "code": -1,
        "msg": "Invalid type for parameter: type, expected str ",
        "result": [],
        "error": "INVALID_PARAMETER_TYPE"
    }
{% endhighlight %}
