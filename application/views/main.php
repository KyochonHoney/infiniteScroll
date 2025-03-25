<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>무한 스크롤</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        #loading {
            display: none;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1>회원 등록일 목록</h1>
        <div id="data-list">
            <?php foreach ($list as $item): ?>
                <div class="alert alert-info"><?= $item->REG_DATE ?></div>
            <?php endforeach; ?>
        </div>
        <div id="loading">로딩 중...</div>
        <div id="footer">푸터입니다.</div>
    </div>

    <script>
        let offset = 20; // 초기 오프셋
        const loading = document.getElementById('loading');
        const footer = document.getElementById('footer');
        let isLoading = false; // 로딩 상태 체크

        const loadMore = () => {
            if (isLoading) return; // 이미 로딩 중이면 종료
            isLoading = true; // 로딩 시작
            loading.style.display = 'block'; // 로딩 메시지 표시

            fetch(`main/load_more?offset=${offset}`)
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    const dataList = document.getElementById('data-list');
                    if (data.list.length > 0) {
                        data.list.forEach(item => {
                            const div = document.createElement('div');
                            div.className = 'alert alert-info';
                            div.textContent = item.REG_DATE;
                            dataList.appendChild(div);
                        });
                        offset += 20; // 오프셋 증가
                    } else {
                        // 더 이상 데이터가 없을 때
                        alert('더이상 데이터가 없습니다.');
                        return false;
                        const endMessage = document.createElement('div');
                        endMessage.className = 'alert alert-warning';
                        endMessage.textContent = '더 이상 데이터가 없습니다.';
                        dataList.appendChild(endMessage);
                    }
                    loading.style.display = 'none'; // 로딩 메시지 숨기기
                    isLoading = false; // 로딩 종료
                })
                .catch(error => {
                    console.error('Error:', error);
                    loading.style.display = 'none'; // 로딩 메시지 숨기기
                    isLoading = false; // 로딩 종료
                });
        };

        // Intersection Observer 설정
        const observer = new IntersectionObserver((entries) => {
            if (entries[0].isIntersecting) {
                loadMore();
            }
        });

        // 로딩 표시를 위해 감시할 요소 추가
        observer.observe(loading);
        observer.observe(footer);
    </script>
</body>
</html>
