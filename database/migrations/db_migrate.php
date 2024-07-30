<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id('role_id');
            $table->string('role_name');
            $table->timestamps();
        });

        Schema::create('permission_groups', function (Blueprint $table) {
            $table->id('permission_group_id');
            $table->string('permission_group_name');
            $table->string('alias');
            $table->timestamps();
        });

        Schema::create('permissions', function (Blueprint $table) {
            $table->id('permission_id');
            $table->string('permission_name');
            $table->string('alias');
            $table->unsignedBigInteger('permission_group_id');
            $table->timestamps();

            $table->foreign('permission_group_id')
                ->references('permission_group_id')
                ->on('permission_groups')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        Schema::create('user_role', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('role_id');
            $table->timestamps();
            
            $table->foreign('user_id')
                ->references('user_id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('role_id')
                ->references('role_id')
                ->on('roles')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        Schema::create('role_permission', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('role_id');
            $table->unsignedBigInteger('permission_id');
            $table->timestamps();

            $table->foreign('role_id')
                ->references('role_id')
                ->on('roles')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('permission_id')
                ->references('permission_id')
                ->on('permissions')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        Schema::create('provinsi', function (Blueprint $table) {
            $table->id('provinsi_id');
            $table->string('nama_provinsi');
            $table->timestamps();
        });

        Schema::create('kabupaten', function (Blueprint $table) {
            $table->id('kabupaten_id');
            $table->string('nama_kabupaten');
            $table->unsignedBigInteger('provinsi_id');
            $table->timestamps();

            $table->foreign('provinsi_id')
                ->references('provinsi_id')
                ->on('provinsi')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        Schema::create('kantor', function (Blueprint $table) {
            $table->string('kode_kantor', 3)->primary();
            $table->string('nama_kantor');
            $table->string('sequence_kantor')->default('0001');
            $table->string('email_kantor');
            $table->string('nomor_telepon_kantor');
            $table->string('alamat_kantor');
            $table->unsignedBigInteger('provinsi_id');
            $table->unsignedBigInteger('kabupaten_id');
            $table->timestamps();

            $table->foreign('provinsi_id')
                ->references('provinsi_id')
                ->on('provinsi')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('kabupaten_id')
                ->references('kabupaten_id')
                ->on('kabupaten')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        Schema::create('lantai', function (Blueprint $table) {
            $table->id('lantai_id');
            $table->string('nama_lantai');
            $table->string('kode_kantor');
            $table->timestamps();

            $table->foreign('kode_kantor')
                ->references('kode_kantor')
                ->on('kantor')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        Schema::create('ruangan', function (Blueprint $table) {
            $table->id('ruangan_id');
            $table->string('nama_ruangan');
            $table->unsignedBigInteger('lantai_id');
            $table->timestamps();

            $table->foreign('lantai_id')
                ->references('lantai_id')
                ->on('lantai')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        Schema::create('kategori', function (Blueprint $table) {
            $table->id('kategori_id');
            $table->string('nama_kategori');
            $table->timestamps();
        });

        Schema::create('barcode_inventaris', function (Blueprint $table) {
            $table->id('barcode_id');
            $table->string('file_path');
            $table->timestamps();
        });

        Schema::create('input_inventaris', function (Blueprint $table) {
            $table->id('input_inventaris_id');
            $table->date('tanggal_pembelian');
            $table->integer('jumlah_inventaris');
            $table->string('harga_inventaris');
            $table->string('status_input_inventaris');
            $table->string('alasan_rejection')->nullable();
            $table->unsignedBigInteger('pengisi_data');
            $table->unsignedBigInteger('approver_1');
            $table->unsignedBigInteger('approver_2');
            $table->string('kode_kantor');
            $table->unsignedBigInteger('kategori_id');

            $table->timestamps();

            $table->foreign('pengisi_data')
                ->references('user_id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('approver_1')
                ->references('user_id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('approver_2')
                ->references('user_id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('kode_kantor')
                ->references('kode_kantor')
                ->on('kantor')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('kategori_id')
                ->references('kategori_id')
                ->on('kategori')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        Schema::create('inventaris', function (Blueprint $table) {
            $table->id('inventaris_id');
            $table->string('nomor_inventaris')->nullable();
            $table->string('nama_inventaris');
            $table->string('harga_inventaris');
            $table->string('tanggal_pembelian');
            $table->integer('tahun_penyusutan');
            $table->string('kode_kantor');
            $table->unsignedBigInteger('kategori_id');
            $table->unsignedBigInteger('barcode_id');
            $table->unsignedBigInteger('pengisi_data');
            $table->unsignedBigInteger('approver_1');
            $table->unsignedBigInteger('approver_2');
            $table->unsignedBigInteger('input_inventaris_id');
            $table->timestamps();

            $table->foreign('pengisi_data')
                ->references('user_id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('approver_1')
                ->references('user_id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('approver_2')
                ->references('user_id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('kode_kantor')
                ->references('kode_kantor')
                ->on('kantor')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('kategori_id')
                ->references('kategori_id')
                ->on('kategori')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            
            $table->foreign('barcode_id')
                ->references('barcode_id')
                ->on('barcode_inventaris')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            
            $table->foreign('input_inventaris_id')
                ->references('input_inventaris_id')
                ->on('input_inventaris')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        Schema::create('pemindahan_inventaris', function (Blueprint $table) {
            $table->id('pemindahan_inventaris_id');
            $table->string('status_pemindahan_inventaris');
            $table->unsignedBigInteger('pengisi_data');
            $table->unsignedBigInteger('approver_1');
            $table->unsignedBigInteger('approver_2');
            $table->string('alasan_rejection')->nullable();
            $table->string('kode_kantor_tujuan');
            $table->string('inventaris_id');

            $table->foreign('pengisi_data')
                ->references('user_id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('approver_1')
                ->references('user_id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('approver_2')
                ->references('user_id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('kode_kantor_tujuan')
                ->references('kode_kantor')
                ->on('kantor')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('inventaris_id')
                ->references('kode_kantor')
                ->on('kantor')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->timestamps();
        });

        Schema::create('pemindahan_inventaris_inventaris', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pemindahan_inventaris_id');
            $table->unsignedBigInteger('inventaris_id');
            $table->timestamps();

            $table->foreign('pemindahan_inventaris_id')
                ->references('pemindahan_inventaris_id')
                ->on('pemindahan_inventaris')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('inventaris_id')
                ->references('inventaris_id')
                ->on('inventaris')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles');
        Schema::dropIfExists('permission_groups');
        Schema::dropIfExists('permissions');
        Schema::dropIfExists('user_role');
        Schema::dropIfExists('role_permission');
        Schema::dropIfExists('kantor');
        Schema::dropIfExists('lantai');
        Schema::dropIfExists('ruangan');
        Schema::dropIfExists('kategori');
        Schema::dropIfExists('barcode_inventaris');
        Schema::dropIfExists('input_inventaris');
        Schema::dropIfExists('inventaris');
        Schema::dropIfExists('pemindahan_inventaris');
        Schema::dropIfExists('pemindahan_inventaris_inventaris');
    }
};
