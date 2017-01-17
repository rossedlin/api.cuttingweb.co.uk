Vagrant.configure(2) do |config|
    config.vm.box = "ubuntu/trusty64"
    config.vm.network "private_network", ip: "192.168.50.113"

    config.vm.provider :virtualbox do |v|
        v.name = "api.cryslo.vm"
        v.customize ["modifyvm", :id, "--memory", 2048]
    end

    config.vm.synced_folder ".", "/var/www/html"

    config.vm.provision :shell, path: "vagrant.sh"
end