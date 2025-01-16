@extends('layouts.layout')
@section('title', 'О нас')
@section('content')
    <link rel="stylesheet" href="{{asset('css/info_style.css')}}">
    <main class="o-main">
        {{--<section class="c-section-info">
            <div class="c-hero">
                <div class="c-hero_image">
                    <img class="o-media-wrapper" src="{{ asset('img/About.jpg') }}" width="1920" height="1080">
                </div>

            </div>
            <div class="name_page-style">О НАС</div>
        </section>--}}

        <div class="info-bg-block">
            <div class="header-block__about-us" data-aos="fade-up" data-aos-delay="500" data-aos-once="true">О нас</div>
            <div class="header-block__about-us__information" data-aos="fade-up" data-aos-delay="600" data-aos-once="true">
                <div class="square-info" data-aos="fade-up" data-aos-delay="700" data-aos-once="true">
                    <div class="info-title">1</div>
                    <div class="info-subtitle">год</div>
                    <div class="info-text_under-subtitle">успешной работы</div>
                </div>
                <div class="square-info" data-aos="fade-up" data-aos-delay="800" data-aos-once="true">
                    <div class="info-title">1000+</div>
                    <div class="info-subtitle">проектов</div>
                    <div class="info-text_under-subtitle">было нами исполнено</div>
                </div>
                <div class="square-info" data-aos="fade-up" data-aos-delay="900" data-aos-once="true">
                    <div class="info-title">10+</div>
                    <div class="info-subtitle">компаний</div>
                    <div class="info-text_under-subtitle">сотрудничающих с нами</div>
                </div>
                <div class="square-info" data-aos="fade-up" data-aos-delay="1000" data-aos-once="true">
                    <div class="info-title">500+</div>
                    <div class="info-subtitle">положительных</div>
                    <div class="info-text_under-subtitle">отзывов наших клиентов</div>
                </div>
            </div>
        </div>
        <section class="content-info_contact container">
            <div class="header-div" data-aos="fade-right" data-aos-delay="500" data-aos-once="true">Наши сотрудники:</div>
            <div class="info-block_contacts container">
                <div class="info-block_contacts__style" data-aos="flip-up" data-aos-delay="800" data-aos-once="true">
                    <div class="avatar-ico">
                        <img class="avatar-img" src="{{ asset('img/photo_content/contact1.jpg') }}" alt="Женщина">
                    </div>
                    <div class="avatar-name">
                        Алина
                    </div>
                    <div class="avatar-position">
                        Зам.директора
                    </div>
                </div>
                <div class="info-block_contacts__style" data-aos="flip-up" data-aos-delay="900" data-aos-once="true">
                    <div class="avatar-ico">
                        <img class="avatar-img" src="{{ asset('img/photo_content/contact2.jpg') }}" alt="Мужчина">
                    </div>
                    <div class="avatar-name">
                        Михаил
                    </div>
                    <div class="avatar-position">
                        Директор
                    </div>
                </div>
                <div class="info-block_contacts__style" data-aos="flip-up" data-aos-delay="1000" data-aos-once="true">
                    <div class="avatar-ico">
                        <img class="avatar-img" src="{{ asset('img/photo_content/contact3.jpg') }}" alt="Мужчина">
                    </div>
                    <div class="avatar-name">
                        Артем
                    </div>
                    <div class="avatar-position">
                        PR-менеджер
                    </div>
                </div>
            </div>
        </section>

        <section class="content-about_us-company container">
            <div class="header-div" data-aos="fade-right" data-aos-delay="1200" data-aos-once="true">О компании:</div>
            <div class="content-about_us-company__style-text" data-aos="flip-up" data-aos-delay="1300" data-aos-once="true">
                Мы стремимся предоставить нашим клиентам лучший сервис и опыт покупки, поэтому Мы работаем ежедневно с 10:00 до 20:00. Наша команда профессионалов готова помочь с любыми вопросами, связанными с выбором, установкой и обслуживанием компьютерной техники.
            </div>
            <div class="content-about_us-company__style-text" data-aos="flip-up" data-aos-delay="1450" data-aos-once="true">
                Одним из ключевых принципов работы SQUARE-PC является удовлетворение потребностей каждого клиента, вне зависимости от их размера и сложности. Мы предлагаем широкий выбор готовых настольных компьютеров и комплектующих, и всегда готовы помочь нашим клиентам выбрать оптимальный продукт для их задач.
            </div>
            <div class="content-about_us-company__style-text" data-aos="flip-up" data-aos-delay="1600" data-aos-once="true">
                Мы также обращаем большое внимание на качество продукции и обслуживание клиентов. Мы работаем только с проверенными поставщиками и используем только самые надежные комплектующие, чтобы обеспечить максимальную производительность и надежность нашей техники.
            </div>
            <div class="content-about_us-company__style-text m-b-50" data-aos="flip-up" data-aos-delay="1750" data-aos-once="true">
                Компания SQUARE-PC стремится стать лидером в отрасли продажи готовых компьютеров, и мы готовы инвестировать в развитие новых технологий и услуг, чтобы обеспечить нашим клиентам лучший сервис и опыт покупки. Мы благодарны за доверие, которое наши клиенты нам оказывают, и готовы продолжать работать на благо их интересов и потребностей.
            </div>
        </section>

    </main>
@endsection
