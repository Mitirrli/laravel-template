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
```php
public function index(TestRequest $request)
{
    $params = $request->validated();

    return response()->json($params);
}
```

## 5. 常用验证规则
```
1. max
max:value
验证中的字段必须小于或等于 value。字符串、数字、数组或是文件大小的计算方式都用 size规则。

2. size
size:value
验证字段必须与给定值的大小一致。对于字符串，value 对应字符数。对于数字，value 对应给定的整数值（attribute 必须有 numeric 或者 integer 规则）。对于数组，size 对应数组的 count 值。对于文件，size 对应文件大小（单位 kB）。让我们来看几个例子：

'title' => 'size:12';// 验证字符串长度是否为 12...
'seats' => 'integer|size:10';// 验证数字是否为 10...
'tags' => 'array|size:5';// 验证数组的长度（拥有的元素）是否为 5...
'image' => 'file|size:512';// 验证上传的文件是否为 512 kB...

3. distinct
验证数组时，指定的字段不能有任何重复值。

'foo.*.id' => 'distinct'
```
