# 捕获Validate异常直接返回验证结果

## 1. Handle
```
public function render($request, Throwable $exception)
{
    if ($exception instanceof ValidationException) {
        return response()->json(['msg' => $exception->{"validator"}->errors()->first(), 'data' => []], 422);
    }

    return parent::render($request, $exception);
}
```

## 2. 创建Request
`php artisan make:request TestRequest`

## 3. 编写验证条件
```
class TestRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'required|integer'
        ];
    }

    public function messages()
    {
        return [
            'id.required' => 'id不能为空',
            'id.integer' => 'id只能为整数'
        ];
    }
}
```

## 4. 在Controller使用
```
public function index(TestRequest $request)
{
    $params = $request->validated();

    return response()->json($params);
}
```
