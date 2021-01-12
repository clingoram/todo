## Laravel ToDo-list
<p>使用Laradock建置Laravel的環境，MySQL建DB，兩張table，但目前只有用到1張表。</p>
<p>之前都是由controller從model再跟DB那裡(好繞舌)拿回來資料後，再傳到blade(view)顯示出來，</p>
<p>變得不管是更新或刪除都用controller來做處理，又很想知道要如何在Laravel檔案中用JS(例如ajax)，所以找到了axios、Vue，所以這次的todo list小作品想試著用Vue+axios來做做看。</p>
<h3>外觀</h3>

![Todo](/images/todo%20-%20laravel.jpg)

<h3>Postman</h3>
<p>使用postman測試API，看看請求能不能正確接收到</p>
<h4>更新代辦清單狀態</h4>

![Update](/images/postman-todo%20list%20-update.jpg)

<h4>新增代辦事項</h4>

![Store](/images/postman-todo%20list%20-store.jpg)

<h4>把代辦清單都撈出來</h4>

![Index](/images/postman-todo%20list%20-index.jpg)

<h4>刪除代辦事項</h4>

![Delete](/images/postman-todo%20list%20-delete.jpg)
