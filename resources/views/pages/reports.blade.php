@extends('master')
@section('title')
    {{-- {{$title}} --}}
@endsection
@section('stylesheet')
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

<style type="text/css">
	.section-container a {
	    font-size: 16px;
	}
	.content-header-title {
	    font-weight: 500;
	}
	.section-container h3 {
	    font-size: 20px;
	    font-weight: 500;
	}
</style>
@endsection

@section('content')
<div class="content-header row">
    <div class="content-header-left col-md-6 col-12 mb-2">
        <h1 class="content-header-title mb-0">Reports</h1>
        <div class="row breadcrumbs-top"></div>
    </div>
</div>
<div class="content">
	<div class="container">
		<div class="main-container">
			<div class="row">
				<div class="col-md-4">
					<div class="section-container">
						<h3><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAA5UlEQVRIS2NkoDFgpLH5DPSzwMEv/QIDA4M+mT66cGDTTENseuE+cPBL/0+m4WBtBzbNxBoaGBbgUojLcpjDBp8FhIIM5mKyfUBzC4iNcLJ9QHMLSA0iNAfB8wXOZEqhBfB8QfV8gB4ng8sC5GDDlQ8o8gHNLcCWdNFdjM8HHxgYGPgZmP4ZHtgwG1R0EwUc/NLh+sAa/jGdZ2D8//DAxlkKIC5SJGc0MDD8ryfKVIKKGBsPbJrRgGIBiOPgl9HAwPgvgeE/ozxBM7DWLv8fMvxnWgAzHMMCsgwloIl+dTItXA8yEwAUb70ZUz9bPgAAAABJRU5ErkJggg=="/>Receivables</h3>
						<ul>
							<li><a href="{{ route('customer.statment') }}"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAACF0lEQVRIS7VVwXXTQBScvxx8jFMBTgUxFbApIIpSQewDtm6ECjAVBG5SOESpIEIugKWDuALUAfYxvMd+3u5KtmxLYjFkL362387M/3/mL+GZDz0zPv6KQAbTRwCs8uSVrzBvAnkejUB8Z4GZxmoepz4k/gRBpAB+7Qig1Dw5+28EMowkNH8FsCpBjyDoTGWx+hOJVwUymGYALgD64AD5PUD3Ko9H/0wgw2gAzd8tkHg6tp+698N9pxOVxUUXyboCeT4JQTgF0QAaA3uJ0AcwdAAbxTKIUoCvSuBHMJaOEAWYCzAWan5rqt7YVAZT7lCygqBhpbasylj2qO2OyhMrvlZBzYagewikwK+lyj4boNYjwzdD4EUfmj8COHUj2th4a8iHeF2Goz64dwOGGfgKTNf1jOy5aIuEkKovybhNvgXXPWNfM6cVhJa7FTfa1LeScnWYtjSCb81gV6UMpqanb433VR7PmqqQF5MCTC+7QtcaNFmtBubLynL7Ikq7Mr9T81sjaO90EJS2FU/HKkuX1i1auGUn9Nj02mWHHgD6pvJYehPUds9C5clQBtHMrYf64RnEz0+bVDshuyQtQ55cg+gGQJWBKs21XWShzP8m7QO0tLKZYL3c1noWEHpUWbBsl3kPXLDsaV5+bQSm1HINdLhou3WFypMTvxa5p9EMc626PWx2+PZ1M/PyImgDO+R3rwfnEODqzm/8s/cZpIbPtAAAAABJRU5ErkJggg=="/> Customer Statements</a></li>
						</ul>
					</div>
				</div>
				<div class="col-md-4">
					<div class="section-container">
						<h3><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAArklEQVRIS2NkoDFgpLH5DMPIAoeADAeGf//nMzAwKFAYbA8YmBgTD2yYcQBkDjyIHPzTHjD8Z5Sn0HCY9gcHNs1URLXAL/0/lQwHG3Ng00yw4xE+oLUF1HQ9slnDKJnSPIgcaB3Jw8sCWCZBjxdSfIk3o9HcAmqkKGw++MDAwMBPDcMZGP8/PLBxFrhURpRFoOL6/78FFJeojP8fMjAyJWAU11RxORZDRssigiELAFV4RhnbIiJtAAAAAElFTkSuQmCC"/> Payments Received</h3>
						
					</div>
				</div>
				<div class="col-md-4">
					<div class="section-container">
						<h3><i class="fas fa-file-invoice"></i> Recurring Invoices</h3>
						
					</div>
				</div>
				<div class="col-md-4">
					<div class="section-container">
						<h3><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAACEklEQVRIS71VwXHbMBBcII88kw4SVyC7AsMFiKEriD6R9DNdgeUKTP1E5RGlglBQAYYrCN2B3IEbMM4DkBQBkJTi0TiY0YyGPNze7e0tGd75sHfOj4MAYjgdgdM5CKeA/ZlTgKFgGvn9JlvvK7IXQAzHMRi7A/D1QJdbEF2rzTLviusEENEkBXBlLzB6gkaKD6RU/rMwj0T84xQvTIAjAbEvVeJUyew6BGkBeMnLygxY7xHDcVJ1amLmSmaJG+wBVLT8sQFcn9UV1xdENCHzX8nMv2c60vyvjSO6dOnyA7+Nt7bloPIK+GY3ZIYVmJ67BTidbJXMTuqidgBWLYx+Gc7VerkbbECB272XyM6mKXDXRQMQTVcAfW9VH02eAXyqn4t49Bn6owIwCOloimG/lVyMrEYcfo1CBiH3Ne/g7ELlC5O4f+DNLAols7MQoHuArmSb1AVAuZLL2xAtFILbQSeA5TaazgCKbYf+aclyH0AnRV18iHgqoOk+lKxdwFKuj0pm1lb+fchAomQ2tx3Vy9WruK4hl95jlsyTX0WP2YH2Cfdln0wDHXsWUS3arJkBewDp1N3Yvq7+r1WUinGc1OG9T/xvMjtn6Rq7BrYAUnD94Nm15ucAjHPWttKSrKei1sKYoXOkjt93N1F+L5I3fXDcTOWAeQyQ0XW9aI8AK0A670vcctN9HnPMu4Mf/WOSm7uvtqZFKJLGYXUAAAAASUVORK5CYII="/> Payables</h3>
						
					</div>
				</div>
				<div class="col-md-4">
					<div class="section-container">
						<h3><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAABHElEQVRIS+2VwW3CMBSG/xcGqJgANqg6Qd0BsLJBOYFvVScobNBj4JQNCOkCjw3YoGKDXnvJqxIrUlIZOwFFXPDJsp//739/Ipsw8KCB9dEJoGaLGKA3EFRlSMAY0ZqzhEMGgwClTQrIq1uI1pwnKx/EC6icE+2sa3nHKMqqeYE5IB/VPKIXXyd+gDYMyHMpzl/bz6ZTpc3KQujAeWKjc4wAYCnW5e+Ys/SnBYjNFIV8l2ucb87qdAKcE1DaGugMUHp5BPAY+jMC+0fON091TauD2tGVgFZHTkDdciiC//uu+tsC+kbVu4M7oEzA+5HvEd0kovLGfOibfaue5MT77dR9F8VGQYoUQpOLICQnUDRvPkDBJ/MiUOPQ4IA/kgGzGeLunyAAAAAASUVORK5CYII="/> Purchases and Expenses</h3>
						
					</div>
				</div>
				<div class="col-md-4">
					<div class="section-container">
						<h3><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAABxklEQVRIS71VwVXCQBD9GyuwArECsQJCAYRYgVwkuQEViBWIN4IHsQKTUIBbQqhA6ICrl4xvlyQEdpcQ3sN9L5e8mfn7Z/78ZbjwYReuj0oAu+P3YFELhCYgP3ESMCQsRfi9CKJjlzQC2J2+C8ZeATQqWK5ANOKLWaiL0wLYjjcBMKjZvgmPg9FhjgJwZvG87huPg2EZZA8ga8uX6eY8DmS87XhkZEf0UG7XPkC3vwKxG01yBCsd8/A9kQBi8IzETe80sSseB7f5/wIgS/rQJCi0JYjrN5DSj5ZJicUOwPHnAD0qCdbvNQ/nm9JsNrDStmBjO55QTlcFYZ88nvbE/xKAJ+grlHd99zlArROVlfA4uD8E0A9uq3Eh2+LY7lMT6ZUL0HOVIMoMzMoAjWFRlA85L2p3+sNsGRWcnHlli/RDBOeLoH1EskseB9JWzhmyyJPKMitJN+St92iWjL3weDrWMTFuvU6mkq5p0RhCsPSlWDTXt0E0AMFVgBmteTQrDPJ/rSIb2jlOeprZFfI7z661lnL8wbEwMZjfrvWM1kgxrPXg7G2tVJcltlboOreSJcASUBqaCitueqLH1A6rfPRrVzxI+AOOCd0ZrLmA6AAAAABJRU5ErkJggg=="/> Taxes</h3>
						
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection