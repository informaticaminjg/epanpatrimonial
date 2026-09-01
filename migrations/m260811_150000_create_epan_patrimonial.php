<?php

use yii\db\Migration;

class m260811_150000_create_epan_patrimonial extends Migration
{
    public function safeUp()
    {
        $this->createTable('epan_bien', [
            'id' => $this->primaryKey(),
            'matricula' => $this->string(50)->notNull()->unique(),
            'codigo_barras' => $this->string(100)->notNull()->unique(),
            'numero_serie' => $this->string(100),
            'descripcion' => $this->string(255)->notNull(),
            'marca' => $this->string(100),
            'modelo' => $this->string(100),
            'categoria' => $this->string(100),
            'estado' => $this->string(50),
            'fecha_alta' => $this->date(),
            'valor_adquisicion' => $this->decimal(14,2),
            'dependencia_actual' => $this->string(150),
            'ubicacion_actual' => $this->string(150),
            'observaciones' => $this->text(),
            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime(),
        ]);

        $this->createTable('epan_persona', [
            'id' => $this->primaryKey(),
            'nombre' => $this->string(150)->notNull(),
            'dni' => $this->string(30),
            'dependencia' => $this->string(150),
            'telefono' => $this->string(50),
            'email' => $this->string(150),
        ]);

        $this->createTable('epan_bien_persona', [
            'id' => $this->primaryKey(),
            'bien_id' => $this->integer()->notNull(),
            'persona_id' => $this->integer()->notNull(),
            'desde' => $this->date(),
            'hasta' => $this->date()->null(),
            'rol' => $this->string(80),
        ]);

        $this->createIndex(
            'idx_epan_bien_persona_bien',
            'epan_bien_persona',
            'bien_id'
        );

        $this->createIndex(
            'idx_epan_bien_persona_persona',
            'epan_bien_persona',
            'persona_id'
        );

        $this->createTable('epan_historial_escaneo', [
            'id' => $this->primaryKey(),
            'usuario_id' => $this->integer()->notNull(),
            'bien_id' => $this->integer()->notNull(),
            'tipo' => $this->string(30)->notNull(),
            'valor' => $this->string(150),
            'fecha_hora' => $this->dateTime()->notNull(),
        ]);

        $this->createTable('epan_usuario_cuenta', [
            'id' => $this->primaryKey(),
            'nombre' => $this->string(150),
            'email' => $this->string(150),
            'dependencia' => $this->string(150),
            'telefono' => $this->string(50),
        ]);

        $this->batchInsert('epan_persona',
            ['id','nombre','dni','dependencia','telefono','email'],
            [
                [1,'Luis Eduardo Garcia','28.456.789','Dirección de Informática','+54 9 299 123-4567','luis.garcia@municipalidad.gob.ar'],
                [2,'María Rosa López','31.456.789','Dirección de Sistemas','+54 9 299 765-4321','maria.lopez@municipalidad.gob.ar'],
                [3,'Carlos Alberto Pérez','26.123.456','Administración','+54 9 299 555-8899','carlos.perez@municipalidad.gob.ar'],
            ]
        );

        $now = date('Y-m-d H:i:s');

        $this->batchInsert('epan_bien',
            ['id','matricula','codigo_barras','numero_serie','descripcion','marca','modelo','categoria','estado','fecha_alta','valor_adquisicion','dependencia_actual','ubicacion_actual','observaciones','created_at','updated_at'],
            [
                [1,'MAT-2024-000123','1234567890123','DLT5420-ABC1234','Notebook Dell Latitude 5420','Dell','Latitude 5420','Equipos Informáticos','Bueno','2024-03-15',1250000,'Dirección de Informática','Oficina 204','Equipo asignado para tareas administrativas y técnicas.',$now,$now],
                [2,'MAT-2024-000122','1234567890124','SILL-ERG-88991','Silla Ejecutiva Ergonómica','Rossi','Executive Pro','Mobiliario','Bueno','2024-02-10',185000,'Dirección de Sistemas','Oficina 101','Silla con respaldo alto.',$now,$now],
                [3,'MAT-2024-000121','1234567890125','EPX-4509-9911','Proyector Epson EX49','Epson','EX49','Equipos Audiovisuales','Muy bueno','2024-01-20',950000,'Administración','Sala de reuniones','Proyector multimedia.',$now,$now],
                [4,'MAT-2024-000120','1234567890126','HPLJ-AB9988','Impresora HP LaserJet','HP','LaserJet Pro','Equipos Informáticos','Regular','2023-11-03',430000,'Mesa de Entradas','Oficina 12','Requiere mantenimiento preventivo.',$now,$now],
                [5,'MAT-2024-000119','1234567890127','SAM-22-884422','Monitor Samsung 24 pulgadas','Samsung','S24R350','Equipos Informáticos','Bueno','2023-10-12',280000,'Dirección de Informática','Oficina 205','',$now,$now],
            ]
        );

        $this->batchInsert('epan_bien_persona',
            ['id','bien_id','persona_id','desde','hasta','rol'],
            [
                [1,1,1,'2024-03-15',null,'Responsable actual'],
                [2,1,2,'2023-01-10','2024-03-14','Responsable anterior'],
                [3,2,3,'2024-02-10',null,'Responsable actual'],
                [4,3,2,'2024-01-20',null,'Responsable actual'],
                [5,4,1,'2023-11-03',null,'Responsable actual'],
                [6,5,1,'2023-10-12','2025-02-28','Responsable anterior'],
            ]
        );

        $this->insert('epan_usuario_cuenta', [
            'id' => 1,
            'nombre' => 'Luis Eduardo Garcia',
            'email' => 'luis.garcia@municipalidad.gob.ar',
            'dependencia' => 'Dirección de Informática',
            'telefono' => '+54 9 299 123-4567',
        ]);

        $this->batchInsert('epan_historial_escaneo',
            ['usuario_id','bien_id','tipo','valor','fecha_hora'],
            [
                [1,1,'matricula','MAT-2024-000123',date('Y-m-d 09:30:00')],
                [1,2,'barcode','1234567890124',date('Y-m-d 09:15:00')],
                [1,3,'matricula','MAT-2024-000121',date('Y-m-d 08:45:00')],
            ]
        );
    }

    public function safeDown()
    {
        $this->dropTable('epan_historial_escaneo');
        $this->dropTable('epan_usuario_cuenta');
        $this->dropTable('epan_bien_persona');
        $this->dropTable('epan_persona');
        $this->dropTable('epan_bien');
    }
}
