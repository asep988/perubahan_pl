PGDMP     4    *                z            db_permohonan    11.18    11.18 !    $           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                       false            %           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                       false            &           0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                       false            '           1262    17080    db_permohonan    DATABASE     ?   CREATE DATABASE db_permohonan WITH TEMPLATE = template0 ENCODING = 'UTF8' LC_COLLATE = 'English_Indonesia.1252' LC_CTYPE = 'English_Indonesia.1252';
    DROP DATABASE db_permohonan;
             postgres    false            ?            1259    24664    failed_jobs    TABLE     ?   CREATE TABLE public.failed_jobs (
    id bigint NOT NULL,
    connection text NOT NULL,
    queue text NOT NULL,
    payload text NOT NULL,
    exception text NOT NULL,
    failed_at timestamp(0) without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL
);
    DROP TABLE public.failed_jobs;
       public         postgres    false            ?            1259    24662    failed_jobs_id_seq    SEQUENCE     {   CREATE SEQUENCE public.failed_jobs_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 )   DROP SEQUENCE public.failed_jobs_id_seq;
       public       postgres    false    201            (           0    0    failed_jobs_id_seq    SEQUENCE OWNED BY     I   ALTER SEQUENCE public.failed_jobs_id_seq OWNED BY public.failed_jobs.id;
            public       postgres    false    200            ?            1259    24643 
   migrations    TABLE     ?   CREATE TABLE public.migrations (
    id integer NOT NULL,
    migration character varying(255) NOT NULL,
    batch integer NOT NULL
);
    DROP TABLE public.migrations;
       public         postgres    false            ?            1259    24641    migrations_id_seq    SEQUENCE     ?   CREATE SEQUENCE public.migrations_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 (   DROP SEQUENCE public.migrations_id_seq;
       public       postgres    false    197            )           0    0    migrations_id_seq    SEQUENCE OWNED BY     G   ALTER SEQUENCE public.migrations_id_seq OWNED BY public.migrations.id;
            public       postgres    false    196            ?            1259    24676    skkl    TABLE       CREATE TABLE public.skkl (
    id bigint NOT NULL,
    nama_usaha text NOT NULL,
    jenis_usaha text NOT NULL,
    penanggung text NOT NULL,
    nib text NOT NULL,
    knli text NOT NULL,
    jabatan text NOT NULL,
    alamat text NOT NULL,
    lokasi text NOT NULL,
    nama_usaha_baru text NOT NULL,
    jenis_usaha_baru text NOT NULL,
    penanggung_baru text NOT NULL,
    nib_baru text NOT NULL,
    knli_baru text NOT NULL,
    jabatan_baru text NOT NULL,
    alamat_baru text NOT NULL,
    lokasi_baru text NOT NULL,
    kabupaten_kota text NOT NULL,
    provinsi text NOT NULL,
    nomor_pl text NOT NULL,
    tgl_pl date NOT NULL,
    perihal text NOT NULL,
    il_dkk text NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
    DROP TABLE public.skkl;
       public         postgres    false            ?            1259    24674    skkl_id_seq    SEQUENCE     t   CREATE SEQUENCE public.skkl_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 "   DROP SEQUENCE public.skkl_id_seq;
       public       postgres    false    203            *           0    0    skkl_id_seq    SEQUENCE OWNED BY     ;   ALTER SEQUENCE public.skkl_id_seq OWNED BY public.skkl.id;
            public       postgres    false    202            ?            1259    24651    users    TABLE     x  CREATE TABLE public.users (
    id bigint NOT NULL,
    name character varying(255) NOT NULL,
    email character varying(255) NOT NULL,
    email_verified_at timestamp(0) without time zone,
    password character varying(255) NOT NULL,
    remember_token character varying(100),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
    DROP TABLE public.users;
       public         postgres    false            ?            1259    24649    users_id_seq    SEQUENCE     u   CREATE SEQUENCE public.users_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 #   DROP SEQUENCE public.users_id_seq;
       public       postgres    false    199            +           0    0    users_id_seq    SEQUENCE OWNED BY     =   ALTER SEQUENCE public.users_id_seq OWNED BY public.users.id;
            public       postgres    false    198            ?
           2604    24667    failed_jobs id    DEFAULT     p   ALTER TABLE ONLY public.failed_jobs ALTER COLUMN id SET DEFAULT nextval('public.failed_jobs_id_seq'::regclass);
 =   ALTER TABLE public.failed_jobs ALTER COLUMN id DROP DEFAULT;
       public       postgres    false    200    201    201            ?
           2604    24646    migrations id    DEFAULT     n   ALTER TABLE ONLY public.migrations ALTER COLUMN id SET DEFAULT nextval('public.migrations_id_seq'::regclass);
 <   ALTER TABLE public.migrations ALTER COLUMN id DROP DEFAULT;
       public       postgres    false    196    197    197            ?
           2604    24679    skkl id    DEFAULT     b   ALTER TABLE ONLY public.skkl ALTER COLUMN id SET DEFAULT nextval('public.skkl_id_seq'::regclass);
 6   ALTER TABLE public.skkl ALTER COLUMN id DROP DEFAULT;
       public       postgres    false    203    202    203            ?
           2604    24654    users id    DEFAULT     d   ALTER TABLE ONLY public.users ALTER COLUMN id SET DEFAULT nextval('public.users_id_seq'::regclass);
 7   ALTER TABLE public.users ALTER COLUMN id DROP DEFAULT;
       public       postgres    false    199    198    199                      0    24664    failed_jobs 
   TABLE DATA               [   COPY public.failed_jobs (id, connection, queue, payload, exception, failed_at) FROM stdin;
    public       postgres    false    201   
&                 0    24643 
   migrations 
   TABLE DATA               :   COPY public.migrations (id, migration, batch) FROM stdin;
    public       postgres    false    197   '&       !          0    24676    skkl 
   TABLE DATA               1  COPY public.skkl (id, nama_usaha, jenis_usaha, penanggung, nib, knli, jabatan, alamat, lokasi, nama_usaha_baru, jenis_usaha_baru, penanggung_baru, nib_baru, knli_baru, jabatan_baru, alamat_baru, lokasi_baru, kabupaten_kota, provinsi, nomor_pl, tgl_pl, perihal, il_dkk, created_at, updated_at) FROM stdin;
    public       postgres    false    203   ?&                 0    24651    users 
   TABLE DATA               u   COPY public.users (id, name, email, email_verified_at, password, remember_token, created_at, updated_at) FROM stdin;
    public       postgres    false    199   ?+       ,           0    0    failed_jobs_id_seq    SEQUENCE SET     A   SELECT pg_catalog.setval('public.failed_jobs_id_seq', 1, false);
            public       postgres    false    200            -           0    0    migrations_id_seq    SEQUENCE SET     ?   SELECT pg_catalog.setval('public.migrations_id_seq', 3, true);
            public       postgres    false    196            .           0    0    skkl_id_seq    SEQUENCE SET     :   SELECT pg_catalog.setval('public.skkl_id_seq', 18, true);
            public       postgres    false    202            /           0    0    users_id_seq    SEQUENCE SET     ;   SELECT pg_catalog.setval('public.users_id_seq', 1, false);
            public       postgres    false    198            ?
           2606    24673    failed_jobs failed_jobs_pkey 
   CONSTRAINT     Z   ALTER TABLE ONLY public.failed_jobs
    ADD CONSTRAINT failed_jobs_pkey PRIMARY KEY (id);
 F   ALTER TABLE ONLY public.failed_jobs DROP CONSTRAINT failed_jobs_pkey;
       public         postgres    false    201            ?
           2606    24648    migrations migrations_pkey 
   CONSTRAINT     X   ALTER TABLE ONLY public.migrations
    ADD CONSTRAINT migrations_pkey PRIMARY KEY (id);
 D   ALTER TABLE ONLY public.migrations DROP CONSTRAINT migrations_pkey;
       public         postgres    false    197            ?
           2606    24684    skkl skkl_pkey 
   CONSTRAINT     L   ALTER TABLE ONLY public.skkl
    ADD CONSTRAINT skkl_pkey PRIMARY KEY (id);
 8   ALTER TABLE ONLY public.skkl DROP CONSTRAINT skkl_pkey;
       public         postgres    false    203            ?
           2606    24661    users users_email_unique 
   CONSTRAINT     T   ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_email_unique UNIQUE (email);
 B   ALTER TABLE ONLY public.users DROP CONSTRAINT users_email_unique;
       public         postgres    false    199            ?
           2606    24659    users users_pkey 
   CONSTRAINT     N   ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);
 :   ALTER TABLE ONLY public.users DROP CONSTRAINT users_pkey;
       public         postgres    false    199                  x?????? ? ?         \   x?U??
? ???a?s???%Z'(?@??So?1c#ņ?1L?(6?$1![D??
.03j??ÞAv\???????t*???}(??i?_?!?      !   O  x???Ko?6??ү?)h???C?6?m?wo??"ơ%Q?(???!e[??$N?]M???g?͓?Ί?T??pf?n?H@,@V?t.?G2W?R??G???X??߻4????YV?j.I???T?J?jp??;7@??q?b4:?3?(??$?x?|i?@??[^5Z?t?xQ?)8 ?l? KH U8)??7??l??rg?D
??hR?G?EY?*w|???Q?9????9+?󳜟Cv?k??U?1r???_\?????? ???rP??Pt?r?2???D?e?~t??w?'????S?&s???`?Ll2w???Uh?<??3?-}?71zޞ>?????wр?Y)K|h?\ ?]?M?K?^?$Y????I?@ E??f?>[??+????
??"cڊ?ɑ??[t?A?y6?;~?ޢO{?P?-?b????I??x?B?(??(?'6?;yӊ??.?t??O??\?j????w~?,	?C?˭mT<?rB?$e?	??????}?J?Qh????Ow84??(
?AG??V)???y?/,Z?}?u̐??xTW?Id????xG^??? ?o??
3?D???sg??)0?oJ?r?)??H?]??ӈ?R`A!?t??????
???F; 4?!'6?:??D?5s̡IGፃ[?x?4*p????؞i??lz&?uY??++=??fk?V?0Yf?Q0ac/?GQ<m27z??i?????؏l2G???	:?g??X????pa??\?|S?@?2???q{ζt?`?۾d<D'??,x%?~????+l??JO׽??^I?fi???g2??őo?u#??\?;???(4??cWۉdo?w?n????J?7???.N/?&/???????4?mo??2?kN??悺?n??r?6??)׆??o2?????aR?M?g?5şG?u=[(T?Ac??P/?????opQ˶w?~?(wk???1??N|:?ܷ?\:^?T???B?j??A???q{?܏D"?S??l?@???4?????Iu??G??)- ?bo??}-s????}{?.?a??N?;?`p=?d.??ο?{??r?B?R?SAR??????'??v'???????͕?}?*l?.Ќ????tg?<??ݣ"W??
?M???տ??өwLO??ߣ>?]?o'F??Jh1?zum??:?F???G?E]?*?_b!?B?d9/ɗ??O??4?c?3???q?Y?|?j???,???7.$'=w?(yO???ul?4? ;?Kg?8N7U?'???????5ۄ8p?;(5????%??????4!???T??5j?&iw??m????]&?v??wU?$jyOd????F??d.^?>??#?^dzp?ڹ?#?vRj?<?????u? ?%*?            x?????? ? ?     