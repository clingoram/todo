<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>ToDo List Documentation</title>

    <link href="https://fonts.googleapis.com/css?family=PT+Sans&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset("vendor/scribe/css/theme-default.style.css") }}" media="screen">
    <link rel="stylesheet" href="{{ asset("vendor/scribe/css/theme-default.print.css") }}" media="print">

    <script src="https://cdn.jsdelivr.net/npm/lodash@4.17.10/lodash.min.js"></script>

    <link rel="stylesheet"
          href="https://unpkg.com/@highlightjs/cdn-assets@10.7.2/styles/obsidian.min.css">
    <script src="https://unpkg.com/@highlightjs/cdn-assets@10.7.2/highlight.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jets/0.14.1/jets.min.js"></script>

    <style id="language-style">
        /* starts out as display none and is replaced with js later  */
                    body .content .bash-example code { display: none; }
                    body .content .javascript-example code { display: none; }
            </style>

    <script>
        var baseUrl = "http://localhost";
        var useCsrf = Boolean();
        var csrfUrl = "/sanctum/csrf-cookie";
    </script>
    <script src="{{ asset("vendor/scribe/js/tryitout-3.21.0.js") }}"></script>

    <script src="{{ asset("vendor/scribe/js/theme-default-3.21.0.js") }}"></script>

</head>

<body data-languages="[&quot;bash&quot;,&quot;javascript&quot;]">

<a href="#" id="nav-button">
    <span>
        MENU
        <img src="{{ asset("vendor/scribe/images/navbar.png") }}" alt="navbar-image" />
    </span>
</a>
<div class="tocify-wrapper">
    
            <div class="lang-selector">
                                            <button type="button" class="lang-button" data-language-name="bash">bash</button>
                                            <button type="button" class="lang-button" data-language-name="javascript">javascript</button>
                    </div>
    
    <div class="search">
        <input type="text" class="search" id="input-search" placeholder="Search">
    </div>

    <div id="toc">
                                                                            <ul id="tocify-header-0" class="tocify-header">
                    <li class="tocify-item level-1" data-unique="introduction">
                        <a href="#introduction">Introduction</a>
                    </li>
                                            
                                                                    </ul>
                                                <ul id="tocify-header-1" class="tocify-header">
                    <li class="tocify-item level-1" data-unique="authenticating-requests">
                        <a href="#authenticating-requests">Authenticating requests</a>
                    </li>
                                            
                                                </ul>
                    
                    <ul id="tocify-header-2" class="tocify-header">
                <li class="tocify-item level-1" data-unique="category-management">
                    <a href="#category-management">Category management</a>
                </li>
                                    <ul id="tocify-subheader-category-management" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="category-management-GETapi-items-categories">
                        <a href="#category-management-GETapi-items-categories">取得所有分類</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="category-management-POSTapi-items-categories">
                        <a href="#category-management-POSTapi-items-categories">新增分類</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="category-management-DELETEapi-items-categories--id-">
                        <a href="#category-management-DELETEapi-items-categories--id-">刪除分類</a>
                    </li>
                                                    </ul>
                            </ul>
                    <ul id="tocify-header-3" class="tocify-header">
                <li class="tocify-item level-1" data-unique="tasks-management">
                    <a href="#tasks-management">Tasks management</a>
                </li>
                                    <ul id="tocify-subheader-tasks-management" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="tasks-management-GETapi-items--id-">
                        <a href="#tasks-management-GETapi-items--id-">顯示特定待辦事項</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="tasks-management-PUTapi-items--id-">
                        <a href="#tasks-management-PUTapi-items--id-">更新</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="tasks-management-DELETEapi-items--id-">
                        <a href="#tasks-management-DELETEapi-items--id-">刪除特定待辦項目</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="tasks-management-GETapi-items">
                        <a href="#tasks-management-GETapi-items">取得所有待辦事項資料</a>
                    </li>
                                    <li class="tocify-item level-2" data-unique="tasks-management-POSTapi-items">
                        <a href="#tasks-management-POSTapi-items">新增待辦事項</a>
                    </li>
                                                    </ul>
                            </ul>
        
                        
            </div>

            <ul class="toc-footer" id="toc-footer">
                            <li><a href="{{ route("scribe.postman") }}">View Postman collection</a></li>
                            <li><a href="{{ route("scribe.openapi") }}">View OpenAPI spec</a></li>
                            <li><a href="http://github.com/knuckleswtf/scribe">Documentation powered by Scribe ✍</a></li>
                    </ul>
        <ul class="toc-footer" id="last-updated">
        <li>Last updated: January 25 2022</li>
    </ul>
</div>

<div class="page-wrapper">
    <div class="dark-box"></div>
    <div class="content">
        <h1 id="introduction">Introduction</h1>
<p>This documentation aims to provide all the information you need to work with our API.</p>
<aside>As you scroll, you'll see code examples for working with the API in different programming languages in the dark area to the right (or as part of the content on mobile).
You can switch the language used with the tabs at the top right (or from the nav menu at the top left on mobile).</aside>
<blockquote>
<p>Base URL</p>
</blockquote>
<pre><code class="language-yaml">http://localhost</code></pre>

        <h1 id="authenticating-requests">Authenticating requests</h1>
<p>This API is not authenticated.</p>

        <h1 id="category-management">Category management</h1>

    <p>APIs for manage categories.</p>

            <h2 id="category-management-GETapi-items-categories">取得所有分類</h2>

<p>
</p>

<p>在modal內，顯示所有分類項目</p>

<span id="example-requests-GETapi-items-categories">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/items/categories" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/items/categories"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-items-categories">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json">{
 &quot;id&quot;: 1,
 &quot;name&quot;: &quot;Work&quot;,
 &quot;created_at&quot;: &quot;2021-12-28 10:00:05&quot;,
}</code>
 </pre>
            <blockquote>
            <p>Example response (400):</p>
        </blockquote>
                <pre>

<code class="language-json">{
 &quot;status&quot;: false,
 &quot;message&quot;: &quot;name不能為空&quot;,
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-items-categories" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-items-categories"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-items-categories"></code></pre>
</span>
<span id="execution-error-GETapi-items-categories" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-items-categories"></code></pre>
</span>
<form id="form-GETapi-items-categories" data-method="GET"
      data-path="api/items/categories"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-items-categories', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-items-categories"
                    onclick="tryItOut('GETapi-items-categories');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-items-categories"
                    onclick="cancelTryOut('GETapi-items-categories');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-items-categories" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/items/categories</code></b>
        </p>
                    </form>

            <h2 id="category-management-POSTapi-items-categories">新增分類</h2>

<p>
</p>

<p>新增分類項目</p>

<span id="example-requests-POSTapi-items-categories">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/items/categories" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"category\": {
        \"name\": \"h\"
    },
    \"name\": \"Work\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/items/categories"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "category": {
        "name": "h"
    },
    "name": "Work"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-items-categories">
            <blockquote>
            <p>Example response (201):</p>
        </blockquote>
                <pre>

<code class="language-json">{
    &quot;status&quot;: true,
    &quot;message&quot;: &quot;Success&quot;,
    &quot;data_return&quot;: {
        &quot;id&quot;: 3,
        &quot;name&quot;: &quot;工作&quot;,
        &quot;created_at&quot;: &quot;2021-12-23T08:05:52.000000Z&quot;
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (400):</p>
        </blockquote>
                <pre>

<code class="language-json">{
    &quot;status&quot;: false,
    &quot;message&quot;: &quot;todoTask.name不能為空&quot;,
    &quot;data_return&quot;: null
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-items-categories" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-items-categories"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-items-categories"></code></pre>
</span>
<span id="execution-error-POSTapi-items-categories" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-items-categories"></code></pre>
</span>
<form id="form-POSTapi-items-categories" data-method="POST"
      data-path="api/items/categories"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-items-categories', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-items-categories"
                    onclick="tryItOut('POSTapi-items-categories');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-items-categories"
                    onclick="cancelTryOut('POSTapi-items-categories');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-items-categories" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/items/categories</code></b>
        </p>
                    <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <p>
                <b><code>lang</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
                <input type="text"
               name="lang"
               data-endpoint="POSTapi-items-categories"
               value="veritatis"
               data-component="url" hidden>
    <br>
<p>The language</p>
            </p>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <p>
        <details>
            <summary style="padding-bottom: 10px;">
                <b><code>category</code></b>&nbsp;&nbsp;<small>object</small>     <i>optional</i> &nbsp;
<br>

            </summary>
                                                <p>
                        <b><code>category.name</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="category.name"
               data-endpoint="POSTapi-items-categories"
               value="h"
               data-component="body" hidden>
    <br>
<p>value 不能多於 150 個字元。 value 不能小於 1 個字元。.</p>
                    </p>
                                    </details>
        </p>
                <p>
            <b><code>name</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="name"
               data-endpoint="POSTapi-items-categories"
               value="Work"
               data-component="body" hidden>
    <br>
<p>分類名稱</p>
        </p>
        </form>

            <h2 id="category-management-DELETEapi-items-categories--id-">刪除分類</h2>

<p>
</p>

<p>刪除特定分類</p>

<span id="example-requests-DELETEapi-items-categories--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost/api/items/categories/9" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"id\": 8
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/items/categories/9"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "id": 8
};

fetch(url, {
    method: "DELETE",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-items-categories--id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json">{
 &quot;status&quot;: true,
 &quot;message&quot;:&quot;Success&quot;,
 &quot;data_return&quot;:{
     null
 }
}</code>
 </pre>
            <blockquote>
            <p>Example response (204):</p>
        </blockquote>
                <pre>
<code>[Empty response]</code>
 </pre>
    </span>
<span id="execution-results-DELETEapi-items-categories--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-items-categories--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-items-categories--id-"></code></pre>
</span>
<span id="execution-error-DELETEapi-items-categories--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-items-categories--id-"></code></pre>
</span>
<form id="form-DELETEapi-items-categories--id-" data-method="DELETE"
      data-path="api/items/categories/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-items-categories--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-items-categories--id-"
                    onclick="tryItOut('DELETEapi-items-categories--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-items-categories--id-"
                    onclick="cancelTryOut('DELETEapi-items-categories--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-items-categories--id-" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/items/categories/{id}</code></b>
        </p>
                    <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <p>
                <b><code>id</code></b>&nbsp;&nbsp;<small>integer</small>     <i>optional</i> &nbsp;
                <input type="number"
               name="id"
               data-endpoint="DELETEapi-items-categories--id-"
               value="9"
               data-component="url" hidden>
    <br>
<p>requires 分類ID</p>
            </p>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <p>
            <b><code>id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name="id"
               data-endpoint="DELETEapi-items-categories--id-"
               value="8"
               data-component="body" hidden>
    <br>
<p>分類ID</p>
        </p>
        </form>

        <h1 id="tasks-management">Tasks management</h1>

    <p>APIs for manage tasks resource.</p>

            <h2 id="tasks-management-GETapi-items--id-">顯示特定待辦事項</h2>

<p>
</p>

<p>取得單一資料</p>

<span id="example-requests-GETapi-items--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/items/4" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"id\": 3,
    \"name\": \"買衣服\",
    \"classification\": \"購物\",
    \"start\": \"2022-1-12 09:22:36\",
    \"end\": \"2022-1-12 11:30:21\",
    \"state\": \"true\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/items/4"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "id": 3,
    "name": "買衣服",
    "classification": "購物",
    "start": "2022-1-12 09:22:36",
    "end": "2022-1-12 11:30:21",
    "state": "true"
};

fetch(url, {
    method: "GET",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-items--id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json">{
    &quot;status&quot;: true,
    &quot;message&quot;: &quot;Success&quot;,
    &quot;data_return&quot;: {
        &quot;id&quot;: 3,
        &quot;description&quot;: &quot;LeetCode&quot;,
        &quot;status&quot;: 0,
        &quot;created_at&quot;: &quot;2022-01-12T16:00:00.000000Z&quot;,
        &quot;end_at&quot;: &quot;2022-01-21 00:00:00&quot;,
        &quot;name&quot;: &quot;工作&quot;,
        &quot;cId&quot;: 3
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (400):</p>
        </blockquote>
                <pre>

<code class="language-json">{
 &quot;status&quot;: false,
 &quot;message&quot;: &quot;Somethig wrong.&quot;,
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-items--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-items--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-items--id-"></code></pre>
</span>
<span id="execution-error-GETapi-items--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-items--id-"></code></pre>
</span>
<form id="form-GETapi-items--id-" data-method="GET"
      data-path="api/items/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-items--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-items--id-"
                    onclick="tryItOut('GETapi-items--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-items--id-"
                    onclick="cancelTryOut('GETapi-items--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-items--id-" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/items/{id}</code></b>
        </p>
                    <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <p>
                <b><code>id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name="id"
               data-endpoint="GETapi-items--id-"
               value="4"
               data-component="url" hidden>
    <br>
<p>待辦事項ID.</p>
            </p>
                    <p>
                <b><code>lang</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
                <input type="text"
               name="lang"
               data-endpoint="GETapi-items--id-"
               value="voluptatem"
               data-component="url" hidden>
    <br>
<p>The language.</p>
            </p>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <p>
            <b><code>id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name="id"
               data-endpoint="GETapi-items--id-"
               value="3"
               data-component="body" hidden>
    <br>
<p>待辦事項ID</p>
        </p>
                <p>
            <b><code>name</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="name"
               data-endpoint="GETapi-items--id-"
               value="買衣服"
               data-component="body" hidden>
    <br>
<p>待辦事項名稱</p>
        </p>
                <p>
            <b><code>classification</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="classification"
               data-endpoint="GETapi-items--id-"
               value="購物"
               data-component="body" hidden>
    <br>
<p>待辦事項所屬分類</p>
        </p>
                <p>
            <b><code>start</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="start"
               data-endpoint="GETapi-items--id-"
               value="2022-1-12 09:22:36"
               data-component="body" hidden>
    <br>
<p>待辦事項開始日期與時間</p>
        </p>
                <p>
            <b><code>end</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="end"
               data-endpoint="GETapi-items--id-"
               value="2022-1-12 11:30:21"
               data-component="body" hidden>
    <br>
<p>待辦事項結束日期與時間</p>
        </p>
                <p>
            <b><code>state</code></b>&nbsp;&nbsp;<small>boolean.</small>     <i>optional</i> &nbsp;
                <input type="text"
               name="state"
               data-endpoint="GETapi-items--id-"
               value="true"
               data-component="body" hidden>
    <br>
<p>待辦事項狀態 預設true</p>
        </p>
        </form>

            <h2 id="tasks-management-PUTapi-items--id-">更新</h2>

<p>
</p>

<p>更新單一資料</p>

<span id="example-requests-PUTapi-items--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost/api/items/5" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"todoTask\": {
        \"name\": \"\",
        \"start\": \"2022-01-25T16:04:52\",
        \"end\": \"ducimus\",
        \"state\": false
    },
    \"classification\": \"購物\",
    \"name\": \"買衣服\",
    \"start\": \"2022-1-12 09:22:36\",
    \"end\": \"2022-1-12 11:30:21\",
    \"state\": \"true\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/items/5"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "todoTask": {
        "name": "",
        "start": "2022-01-25T16:04:52",
        "end": "ducimus",
        "state": false
    },
    "classification": "購物",
    "name": "買衣服",
    "start": "2022-1-12 09:22:36",
    "end": "2022-1-12 11:30:21",
    "state": "true"
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-items--id-">
</span>
<span id="execution-results-PUTapi-items--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-items--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-items--id-"></code></pre>
</span>
<span id="execution-error-PUTapi-items--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-items--id-"></code></pre>
</span>
<form id="form-PUTapi-items--id-" data-method="PUT"
      data-path="api/items/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-items--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-items--id-"
                    onclick="tryItOut('PUTapi-items--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-items--id-"
                    onclick="cancelTryOut('PUTapi-items--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-items--id-" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/items/{id}</code></b>
        </p>
                    <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <p>
                <b><code>id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name="id"
               data-endpoint="PUTapi-items--id-"
               value="5"
               data-component="url" hidden>
    <br>
<p>待辦事項ID.</p>
            </p>
                    <p>
                <b><code>lang</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
                <input type="text"
               name="lang"
               data-endpoint="PUTapi-items--id-"
               value="ea"
               data-component="url" hidden>
    <br>
<p>The language</p>
            </p>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <p>
        <details>
            <summary style="padding-bottom: 10px;">
                <b><code>todoTask</code></b>&nbsp;&nbsp;<small>object</small>     <i>optional</i> &nbsp;
<br>

            </summary>
                                                <p>
                        <b><code>todoTask.name</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="todoTask.name"
               data-endpoint="PUTapi-items--id-"
               value=""
               data-component="body" hidden>
    <br>
<p>value 不能多於 150 個字元。 value 不能小於 2 個字元。.</p>
                    </p>
                                                                <p>
                        <b><code>todoTask.start</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="todoTask.start"
               data-endpoint="PUTapi-items--id-"
               value="2022-01-25T16:04:52"
               data-component="body" hidden>
    <br>
<p>value 不是有效的日期。.</p>
                    </p>
                                                                <p>
                        <b><code>todoTask.end</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="todoTask.end"
               data-endpoint="PUTapi-items--id-"
               value="ducimus"
               data-component="body" hidden>
    <br>

                    </p>
                                                                <p>
                        <b><code>todoTask.state</code></b>&nbsp;&nbsp;<small>boolean</small>     <i>optional</i> &nbsp;
                <label data-endpoint="PUTapi-items--id-" hidden>
            <input type="radio" name="todoTask.state"
                   value="true"
                   data-endpoint="PUTapi-items--id-"
                   data-component="body"
            >
            <code>true</code>
        </label>
        <label data-endpoint="PUTapi-items--id-" hidden>
            <input type="radio" name="todoTask.state"
                   value="false"
                   data-endpoint="PUTapi-items--id-"
                   data-component="body"
            >
            <code>false</code>
        </label>
    <br>

                    </p>
                                    </details>
        </p>
                <p>
            <b><code>classification</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="classification"
               data-endpoint="PUTapi-items--id-"
               value="購物"
               data-component="body" hidden>
    <br>
<p>待辦事項所屬分類</p>
        </p>
                <p>
            <b><code>name</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="name"
               data-endpoint="PUTapi-items--id-"
               value="買衣服"
               data-component="body" hidden>
    <br>
<p>待辦事項名稱</p>
        </p>
                <p>
            <b><code>start</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="start"
               data-endpoint="PUTapi-items--id-"
               value="2022-1-12 09:22:36"
               data-component="body" hidden>
    <br>
<p>待辦事項開始日期與時間</p>
        </p>
                <p>
            <b><code>end</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="end"
               data-endpoint="PUTapi-items--id-"
               value="2022-1-12 11:30:21"
               data-component="body" hidden>
    <br>
<p>待辦事項結束日期與時間</p>
        </p>
                <p>
            <b><code>state</code></b>&nbsp;&nbsp;<small>boolean.</small>     <i>optional</i> &nbsp;
                <input type="text"
               name="state"
               data-endpoint="PUTapi-items--id-"
               value="true"
               data-component="body" hidden>
    <br>
<p>待辦事項狀態 預設true</p>
        </p>
        </form>

            <h2 id="tasks-management-DELETEapi-items--id-">刪除特定待辦項目</h2>

<p>
</p>

<p>刪除單一項目</p>

<span id="example-requests-DELETEapi-items--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost/api/items/2" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"id\": 2
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/items/2"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "id": 2
};

fetch(url, {
    method: "DELETE",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-items--id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json">{
 &quot;status&quot;: true,
 &quot;message&quot;:&quot;Success&quot;,
 &quot;data_return&quot;:{
     null
 }
}</code>
 </pre>
            <blockquote>
            <p>Example response (204):</p>
        </blockquote>
                <pre>
<code>[Empty response]</code>
 </pre>
    </span>
<span id="execution-results-DELETEapi-items--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-items--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-items--id-"></code></pre>
</span>
<span id="execution-error-DELETEapi-items--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-items--id-"></code></pre>
</span>
<form id="form-DELETEapi-items--id-" data-method="DELETE"
      data-path="api/items/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-items--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-items--id-"
                    onclick="tryItOut('DELETEapi-items--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-items--id-"
                    onclick="cancelTryOut('DELETEapi-items--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-items--id-" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/items/{id}</code></b>
        </p>
                    <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <p>
                <b><code>id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name="id"
               data-endpoint="DELETEapi-items--id-"
               value="2"
               data-component="url" hidden>
    <br>
<p>待辦項目ID</p>
            </p>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <p>
            <b><code>id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
                <input type="number"
               name="id"
               data-endpoint="DELETEapi-items--id-"
               value="2"
               data-component="body" hidden>
    <br>
<p>待辦項目ID</p>
        </p>
        </form>

            <h2 id="tasks-management-GETapi-items">取得所有待辦事項資料</h2>

<p>
</p>

<p>在月曆上，顯示該月份所有待辦事項資料</p>

<span id="example-requests-GETapi-items">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/items?sort=DESC" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/items"
);

const params = {
    "sort": "DESC",
};
Object.keys(params)
    .forEach(key =&gt; url.searchParams.append(key, params[key]));

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-items">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json">{
    &quot;id&quot;: 4,
    &quot;title&quot;: &quot;LeetCode&quot;,
    &quot;status&quot;: true,
    &quot;category&quot;: &quot;Coding&quot;,
    &quot;start&quot;: &quot;2021-12-28 10:00:05&quot;,
    &quot;end&quot;: &quot;2021-12-30 12:21:07&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (400):</p>
        </blockquote>
                <pre>

<code class="language-json">{
 &quot;status&quot;: false,
 &quot;message&quot;: &quot;todoTask.name不能為空&quot;,
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-items" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-items"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-items"></code></pre>
</span>
<span id="execution-error-GETapi-items" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-items"></code></pre>
</span>
<form id="form-GETapi-items" data-method="GET"
      data-path="api/items"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-items', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-items"
                    onclick="tryItOut('GETapi-items');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-items"
                    onclick="cancelTryOut('GETapi-items');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-items" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/items</code></b>
        </p>
                        <h4 class="fancy-heading-panel"><b>Query Parameters</b></h4>
                    <p>
                <b><code>sort</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
                <input type="text"
               name="sort"
               data-endpoint="GETapi-items"
               value="DESC"
               data-component="query" hidden>
    <br>
<p>設定排序方式</p>
            </p>
                </form>

            <h2 id="tasks-management-POSTapi-items">新增待辦事項</h2>

<p>
</p>

<p>新增資料</p>

<span id="example-requests-POSTapi-items">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/items" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"todoTask\": {
        \"name\": \"vs\",
        \"start\": \"2022-01-25T16:04:52\",
        \"end\": \"2022-01-25T16:04:52\",
        \"state\": true
    },
    \"classificationSelected\": 67765.226140346,
    \"name\": \"買衣服\",
    \"classification\": \"購物\",
    \"start\": \"2022-1-12 09:22:36\",
    \"end\": \"2022-1-12 11:30:21\",
    \"state\": \"true\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/items"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "todoTask": {
        "name": "vs",
        "start": "2022-01-25T16:04:52",
        "end": "2022-01-25T16:04:52",
        "state": true
    },
    "classificationSelected": 67765.226140346,
    "name": "買衣服",
    "classification": "購物",
    "start": "2022-1-12 09:22:36",
    "end": "2022-1-12 11:30:21",
    "state": "true"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-items">
            <blockquote>
            <p>Example response (201):</p>
        </blockquote>
                <pre>

<code class="language-json">{
 &quot;status&quot;: true,
 &quot;message&quot;:&quot;Success&quot;,
 &quot;data_return&quot;:{
     null
 }
}</code>
 </pre>
            <blockquote>
            <p>Example response (400):</p>
        </blockquote>
                <pre>

<code class="language-json">{
    &quot;status&quot;: false,
    &quot;message&quot;: &quot;todoTask.name不能為空&quot;,
    &quot;data_return&quot;: null
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-items" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-items"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-items"></code></pre>
</span>
<span id="execution-error-POSTapi-items" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-items"></code></pre>
</span>
<form id="form-POSTapi-items" data-method="POST"
      data-path="api/items"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}'
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-items', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-items"
                    onclick="tryItOut('POSTapi-items');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-items"
                    onclick="cancelTryOut('POSTapi-items');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-items" hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/items</code></b>
        </p>
                    <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <p>
                <b><code>lang</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
                <input type="text"
               name="lang"
               data-endpoint="POSTapi-items"
               value="expedita"
               data-component="url" hidden>
    <br>
<p>The language</p>
            </p>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <p>
        <details>
            <summary style="padding-bottom: 10px;">
                <b><code>todoTask</code></b>&nbsp;&nbsp;<small>object</small>     <i>optional</i> &nbsp;
<br>

            </summary>
                                                <p>
                        <b><code>todoTask.name</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="todoTask.name"
               data-endpoint="POSTapi-items"
               value="vs"
               data-component="body" hidden>
    <br>
<p>value 不能多於 150 個字元。 value 不能小於 2 個字元。.</p>
                    </p>
                                                                <p>
                        <b><code>todoTask.start</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="todoTask.start"
               data-endpoint="POSTapi-items"
               value="2022-01-25T16:04:52"
               data-component="body" hidden>
    <br>
<p>value 不是有效的日期。.</p>
                    </p>
                                                                <p>
                        <b><code>todoTask.end</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="todoTask.end"
               data-endpoint="POSTapi-items"
               value="2022-01-25T16:04:52"
               data-component="body" hidden>
    <br>
<p>value 不是有效的日期。.</p>
                    </p>
                                                                <p>
                        <b><code>todoTask.state</code></b>&nbsp;&nbsp;<small>boolean</small>     <i>optional</i> &nbsp;
                <label data-endpoint="POSTapi-items" hidden>
            <input type="radio" name="todoTask.state"
                   value="true"
                   data-endpoint="POSTapi-items"
                   data-component="body"
            >
            <code>true</code>
        </label>
        <label data-endpoint="POSTapi-items" hidden>
            <input type="radio" name="todoTask.state"
                   value="false"
                   data-endpoint="POSTapi-items"
                   data-component="body"
            >
            <code>false</code>
        </label>
    <br>

                    </p>
                                    </details>
        </p>
                <p>
            <b><code>classificationSelected</code></b>&nbsp;&nbsp;<small>number</small>  &nbsp;
                <input type="number"
               name="classificationSelected"
               data-endpoint="POSTapi-items"
               value="67765.226140346"
               data-component="body" hidden>
    <br>

        </p>
                <p>
            <b><code>name</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="name"
               data-endpoint="POSTapi-items"
               value="買衣服"
               data-component="body" hidden>
    <br>
<p>待辦事項名稱</p>
        </p>
                <p>
            <b><code>classification</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="classification"
               data-endpoint="POSTapi-items"
               value="購物"
               data-component="body" hidden>
    <br>
<p>待辦事項所屬分類</p>
        </p>
                <p>
            <b><code>start</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="start"
               data-endpoint="POSTapi-items"
               value="2022-1-12 09:22:36"
               data-component="body" hidden>
    <br>
<p>待辦事項開始日期與時間</p>
        </p>
                <p>
            <b><code>end</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
                <input type="text"
               name="end"
               data-endpoint="POSTapi-items"
               value="2022-1-12 11:30:21"
               data-component="body" hidden>
    <br>
<p>待辦事項結束日期與時間</p>
        </p>
                <p>
            <b><code>state</code></b>&nbsp;&nbsp;<small>boolean.</small>     <i>optional</i> &nbsp;
                <input type="text"
               name="state"
               data-endpoint="POSTapi-items"
               value="true"
               data-component="body" hidden>
    <br>
<p>待辦事項狀態 預設true</p>
        </p>
        </form>

    

        
    </div>
    <div class="dark-box">
                    <div class="lang-selector">
                                                        <button type="button" class="lang-button" data-language-name="bash">bash</button>
                                                        <button type="button" class="lang-button" data-language-name="javascript">javascript</button>
                            </div>
            </div>
</div>
</body>
</html>
