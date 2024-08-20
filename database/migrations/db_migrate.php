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
            $table->string('slug');
            $table->unsignedBigInteger('creator_id')->nullable();
            $table->unsignedBigInteger('editor_id')->nullable();
            $table->timestamps();

            $table->foreign('creator_id')
                ->references('user_id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('editor_id')
                ->references('user_id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
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
            $table->id('kantor_id');
            $table->string('kode_kantor', 3);
            $table->string('nama_kantor');
            $table->string('slug');
            $table->string('sequence_kantor')->default('0001');
            $table->string('nomor_telepon_kantor');
            $table->string('alamat_kantor');
            $table->unsignedBigInteger('provinsi_id');
            $table->unsignedBigInteger('kabupaten_id');
            $table->unsignedBigInteger('creator_id')->nullable();
            $table->unsignedBigInteger('editor_id')->nullable();
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

            $table->foreign('creator_id')
                ->references('user_id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('editor_id')
                ->references('user_id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        Schema::create('lantai', function (Blueprint $table) {
            $table->id('lantai_id');
            $table->string('nama_lantai');
            $table->unsignedBigInteger('kantor_id');
            $table->unsignedBigInteger('creator_id')->nullable();
            $table->unsignedBigInteger('editor_id')->nullable();
            $table->timestamps();

            $table->foreign('kantor_id')
                ->references('kantor_id')
                ->on('kantor')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('creator_id')
                ->references('user_id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('editor_id')
                ->references('user_id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        Schema::create('ruangan', function (Blueprint $table) {
            $table->id('ruangan_id');
            $table->string('nama_ruangan');
            $table->string('detail_ruangan')->nullable();
            $table->unsignedBigInteger('lantai_id');
            $table->unsignedBigInteger('creator_id')->nullable();
            $table->unsignedBigInteger('editor_id')->nullable();
            $table->timestamps();

            $table->foreign('lantai_id')
                ->references('lantai_id')
                ->on('lantai')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('creator_id')
                ->references('user_id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('editor_id')
                ->references('user_id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        Schema::create('kategori', function (Blueprint $table) {
            $table->id('kategori_id');
            $table->string('nama_kategori');
            $table->string('slug');
            $table->unsignedBigInteger('creator_id')->nullable();
            $table->unsignedBigInteger('editor_id')->nullable();
            $table->timestamps();

            $table->foreign('creator_id')
                ->references('user_id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('editor_id')
                ->references('user_id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        Schema::create('qrcode_inventaris', function (Blueprint $table) {
            $table->id('qrcode_id');
            $table->string('file_path');
            $table->timestamps();
        });

        Schema::create('input_inventaris', function (Blueprint $table) {
            $table->id('input_inventaris_id');
            $table->string('judul_input_inventaris');
            $table->string('nama_inventaris');
            $table->date('tanggal_pembelian');
            $table->integer('jumlah_inventaris');
            $table->integer('tahun_penyusutan');
            $table->string('harga_inventaris');
            $table->string('status_input_inventaris');
            $table->string('alasan_rejection')->nullable();
            $table->unsignedBigInteger('creator_id');
            $table->unsignedBigInteger('approver_1');
            $table->unsignedBigInteger('approver_2');
            $table->unsignedBigInteger('kantor_id');
            $table->unsignedBigInteger('lantai_id');
            $table->unsignedBigInteger('ruangan_id');
            $table->unsignedBigInteger('kategori_id');

            $table->timestamps();

            $table->foreign('creator_id')
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

            $table->foreign('kantor_id')
                ->references('kantor_id')
                ->on('kantor')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('lantai_id')
                ->references('lantai_id')
                ->on('lantai')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('ruangan_id')
                ->references('ruangan_id')
                ->on('ruangan')
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
            $table->date('tanggal_pembelian');
            $table->integer('tahun_penyusutan');
            $table->string('status_inventaris');
            $table->string('kondisi_inventaris');
            $table->unsignedBigInteger('kategori_id');
            $table->unsignedBigInteger('kantor_id');
            $table->unsignedBigInteger('lantai_id');
            $table->unsignedBigInteger('ruangan_id');
            $table->unsignedBigInteger('qrcode_id')->nullable();
            $table->unsignedBigInteger('creator_id');
            $table->unsignedBigInteger('approver_1');
            $table->unsignedBigInteger('approver_2');
            $table->unsignedBigInteger('input_inventaris_id')->nullable();
            $table->timestamps();

            $table->foreign('creator_id')
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

            $table->foreign('kantor_id')
                ->references('kantor_id')
                ->on('kantor')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('lantai_id')
                ->references('lantai_id')
                ->on('lantai')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('ruangan_id')
                ->references('ruangan_id')
                ->on('ruangan')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('kategori_id')
                ->references('kategori_id')
                ->on('kategori')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            
            $table->foreign('qrcode_id')
                ->references('qrcode_id')
                ->on('qrcode_inventaris')
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
            $table->string('judul_pemindahan_inventaris');
            $table->string('status_pemindahan_inventaris');
            $table->unsignedBigInteger('creator_id');
            $table->unsignedBigInteger('approver_1');
            $table->unsignedBigInteger('approver_2');
            $table->string('alasan_rejection')->nullable();
            $table->unsignedBigInteger('kantor_id_tujuan');
            $table->unsignedBigInteger('lantai_id_tujuan');
            $table->unsignedBigInteger('ruangan_id_tujuan');

            $table->foreign('creator_id')
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

            $table->foreign('kantor_id_tujuan')
                ->references('kantor_id')
                ->on('kantor')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('lantai_id_tujuan')
                ->references('lantai_id')
                ->on('lantai')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('ruangan_id_tujuan')
                ->references('ruangan_id')
                ->on('ruangan')
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
        Schema::dropIfExists('qrcode_inventaris');
        Schema::dropIfExists('input_inventaris');
        Schema::dropIfExists('inventaris');
        Schema::dropIfExists('pemindahan_inventaris');
        Schema::dropIfExists('pemindahan_inventaris_inventaris');
    }
};
