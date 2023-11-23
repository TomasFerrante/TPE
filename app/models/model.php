<?php
include_once './config.php';
 class Model {
    protected $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=' .MYSQL_HOST .';dbname=' .MYSQL_DB .';charset=utf8', MYSQL_USER, MYSQL_PASS);
        $this->deploy();
    }

    public function deploy() {
        $query = $this->db->query('SHOW TABLES');
        $tables = $query->fetchAll();
        if(count($tables)==0) {
            $sql =<<<END
            -- --------------------------------------------------------

            --
            -- Table structure for table `album`
            --

            CREATE TABLE `album` (
            `id` int(11) NOT NULL,
            `nombre` varchar(45) NOT NULL,
            `canciones` int(11) NOT NULL,
            `duracion` int(11) NOT NULL,
            `artista` varchar(45) NOT NULL,
            `genero` varchar(45) NOT NULL,
            `lanzamiento` date NOT NULL,
            `precio` int(45) NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

            -- --------------------------------------------------------

            --
            -- Table structure for table `categorias`
            --

            CREATE TABLE `categorias` (
            `id_categoria` int(11) NOT NULL,
            `genero` varchar(100) NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

            -- --------------------------------------------------------

            --
            -- Table structure for table `usuarios`
            --

            CREATE TABLE `usuarios` (
            `id` int(11) NOT NULL,
            `email` varchar(200) NOT NULL,
            `password` varchar(255) NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

            --
            -- Dumping data for table `usuarios`
            --

            INSERT INTO `usuarios` (`id`, `email`, `password`) VALUES
            (1, 'webadmin', '$2y$10$HPPHxvPCbxUSDYVbIRKJPuBpgrE1UC7z9JKwZZubHrgv/ChlK2eie');

            -- --------------------------------------------------------

            --
            -- Table structure for table `ventas`
            --

            CREATE TABLE `ventas` (
            `id` int(11) NOT NULL,
            `id_album` int(45) NOT NULL,
            `via` varchar(45) NOT NULL,
            `tipo` varchar(45) NOT NULL,
            `precio` double NOT NULL,
            `producto` varchar(45) NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

            --
            -- Indexes for dumped tables
            --

            --
            -- Indexes for table `album`
            --
            ALTER TABLE `album`
            ADD PRIMARY KEY (`id`) USING BTREE;

            --
            -- Indexes for table `categorias`
            --
            ALTER TABLE `categorias`
            ADD PRIMARY KEY (`id_categoria`);

            --
            -- Indexes for table `usuarios`
            --
            ALTER TABLE `usuarios`
            ADD PRIMARY KEY (`id`);

            --
            -- Indexes for table `ventas`
            --
            ALTER TABLE `ventas`
            ADD PRIMARY KEY (`id`),
            ADD KEY `fk_id` (`id_album`);

            --
            -- AUTO_INCREMENT for dumped tables
            --

            --
            -- AUTO_INCREMENT for table `album`
            --
            ALTER TABLE `album`
            MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

            --
            -- AUTO_INCREMENT for table `categorias`
            --
            ALTER TABLE `categorias`
            MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

            --
            -- AUTO_INCREMENT for table `usuarios`
            --
            ALTER TABLE `usuarios`
            MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

            --
            -- AUTO_INCREMENT for table `ventas`
            --
            ALTER TABLE `ventas`
            MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

            --
            -- Constraints for dumped tables
            --

            --
            -- Constraints for table `ventas`
            --
            ALTER TABLE `ventas`
            ADD CONSTRAINT `fk_id` FOREIGN KEY (`id_album`) REFERENCES `album` (`id`);
            COMMIT;
            END;
            $this->db->query($sql);
        }
    }
}

?>