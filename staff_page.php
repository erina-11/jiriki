
  <?php include('header.php'); ?>
    </header>
    
    <main>
      <h1>スタッフ紹介</h1>
      <p>ここではサービスの開発や運営に携わるメンバたちを紹介していきます</p>

      <div class="card text-white bg-danger mb-3 rounded-pill" style="max-width: 540px;">
        <div class="row g-0">
          <div class="col-md-4">
            <img src="img/staff/Ueno_icon.png" width="180" height="180" alt="画像">
          </div>
          <div class="col-md-8">
            <div class="card-body">
              <h5 class="card-title">上野老師</h5>
              <p class="card-text">YahooやGREEの元エンジニア。<br>でも三流のため生徒たちと一緒に日々勉強中。<br>生徒たちとアプリやゲームを作って<br>一儲けしたいと夢見ている。</p>
            </div>
          </div>
        </div>
      </div>

      

      <div class="card text-white bg-danger mb-3 rounded-pill" style="max-width: 540px;">
        <div class="row g-0">
          <div class="col-md-4">
            <img src="img/staff/Okada_icon.png" width="180" height="180" alt="画像">
          </div>
          <div class="col-md-8">
            <div class="card-body">
              <h5 class="card-title">オカダ</h5>
              <p class="card-text">プログラミングを勉強中の受験生。<br>このページとか作ってます。<br>「いつか自分でゲーム作りたいなぁ」<br>と漠然と考えてますが、一体いつになるやら...</p>
            </div>
          </div>
        </div>
      </div>

      <div class="card text-white bg-danger mb-3 rounded-pill" style="max-width: 540px;">
        <div class="row g-0">
          <div class="col-md-4">
            <img src="img/staff/Iwasa_icon.png" width="180" height="180" alt="画像">
          </div>
          <div class="col-md-8">
            <div class="card-body">
              <h5 class="card-title">イワサ</h5>
              <p class="card-text">絵を描く事と、読書と、猫が大好きです。<br>プログラミング（HTMLとphp）を勉強していて、<br>今は、この教室のホームページづくりに参加しています。</p>
            </div>
          </div>
        </div>
      </div>

      <div class="card text-white bg-danger mb-3 rounded-pill" style="max-width: 540px;">
        <div class="row g-0">
          <div class="col-md-4">
            <img src="img/staff/Hi_icon.png" width="180" height="180" alt="画像">
          </div>
          <div class="col-md-8">
            <div class="card-body">
              <h5 class="card-title">Hisaki</h5>
              <p class="card-text">いま、HTML,CSS,PHPの勉強をしています。<br>いつか、自分でアプリを作ってみたいです。<br>パソコンが爆発寸前。<br>買い替えを検討中。</p>
            </div>
          </div>
        </div>
      </div>

      <div class="card text-white bg-danger mb-3 rounded-pill" style="max-width: 540px;">
        <div class="row g-0">
          <div class="col-md-4">
            <img src="img/staff/Iizawa_icon.png" width="180" height="180" alt="画像">
          </div>
          <div class="col-md-8">
            <div class="card-body">
              <h5 class="card-title">イイザワ</h5>
              <p class="card-text">上野老師の元生徒です。<br>プログラミングスクールを卒業後、<br>お仕事しながら学習を続けています。</p>
            </div>
          </div>
        </div>
      </div>

      <div class="tab-menu">(押せ)</div>
      <div class="tab-menu">(押すな)</div>

      <div class="tab">
        (○皿○)
      </div>

      <div class="tab inactive">
        <div class="card text-white bg-danger mb-3" style="max-width: 540px;">
          <div class="row g-0">
            <div class="col-md-4">
              <img src="img/staff/テストくん.jpg" width="120" height="120" alt="画像">
            </div>
            <div class="col-md-8">
              <div class="card-body">
                <h5 class="card-title">テストくん</h5>
                <p class="card-text">テスト用キャラです。解雇の日は近い。<br>そしてうちのマスコットです。かわいいね!</p>
              </div>
            </div>
          </div>
        </div>
      </div>

    </main>

    <?php include('footer.php'); ?>

    <script>
      let tabMenus = document.querySelectorAll('.tab-menu');
      let tabMenu1 = tabMenus.item(0);
      let tabMenu2 = tabMenus.item(1);

      let tabs = document.querySelectorAll('.tab');
      let tab1 = tabs.item(0);
      let tab2 = tabs.item(1);

      tabMenu1.addEventListener('click', function() {
        tab1.className = 'tab';
        tab2.className = 'tab inactive';
      });
      tabMenu2.addEventListener('click', function() {
        tab1.className = 'tab inactive';
        tab2.className = 'tab';
      });
      </script>